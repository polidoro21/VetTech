<?php

namespace Tests\Feature;

use App\Models\Animal;
use App\Models\Atendimento;
use App\Models\Clinica;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomerModulesTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_based_login_redirects(): void
    {
        foreach ([
            'tutor' => route('dashboard', absolute: false),
            'vet' => route('vet.atendimentos.index', absolute: false),
            'clinic' => route('clinicas.profile', absolute: false),
            'admin' => route('admin.clinicas.index', absolute: false),
        ] as $tipo => $path) {
            User::factory()->create([
                'tipo' => $tipo,
                'email' => "{$tipo}@example.com",
                'password' => Hash::make('password123'),
            ]);

            $this->post(route('login.post'), [
                'email' => "{$tipo}@example.com",
                'password' => 'password123',
            ])->assertRedirect($path);

            $this->post(route('logout'));
        }
    }

    public function test_customer_pages_render_and_legacy_routes_redirect(): void
    {
        $user = User::factory()->create(['tipo' => 'tutor']);
        $this->actingAs($user);

        Animal::create([
            'id_usuario' => $user->id,
            'nome' => 'Luna',
            'especie' => 'Gato',
            'porte' => 'pequeno',
        ]);

        Clinica::create([
            'nome' => 'Clinica Teste',
            'cidade' => 'Sao Paulo',
            'uf' => 'SP',
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        foreach ([
            route('dashboard'),
            route('animais.index'),
            route('animais.create'),
            route('atendimentos.index'),
            route('atendimentos.create'),
            route('vacinas.index'),
            route('clinicas.index'),
        ] as $url) {
            $this->get($url)->assertOk();
        }

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Atendimentos')
            ->assertDontSee('Telemedicina')
            ->assertDontSee('Proximas consultas');

        $this->get(route('consultas.index'))->assertRedirect(route('atendimentos.index'));
        $this->get(route('consultas.create'))->assertRedirect(route('atendimentos.create'));
        $this->get(route('telemedicina.index'))->assertRedirect(route('atendimentos.index'));
    }

    public function test_clinic_approval_visibility_and_pending_changes(): void
    {
        $admin = User::factory()->create(['tipo' => 'admin']);
        $clinicUser = User::factory()->create(['tipo' => 'clinic']);
        $tutor = User::factory()->create(['tipo' => 'tutor']);

        $this->actingAs($clinicUser)->post(route('clinicas.profile.update'), [
            'nome' => 'Clinica Pendente',
            'tipo' => 'Clinica veterinaria',
            'telefone' => '(11) 3333-4444',
            'email' => 'publico@clinica.test',
            'cidade' => 'Sao Paulo',
            'uf' => 'SP',
            'descricao' => 'Primeira versao',
        ])->assertRedirect(route('clinicas.profile'));

        $clinica = Clinica::firstOrFail();
        $this->assertSame('pending', $clinica->status);

        $this->actingAs($tutor)->get(route('clinicas.index'))
            ->assertOk()
            ->assertDontSee('Clinica Pendente');

        $this->actingAs($admin)->post(route('admin.clinicas.approve', $clinica))
            ->assertRedirect(route('admin.clinicas.index'));

        $this->assertDatabaseHas('clinicas', [
            'nome' => 'Clinica Pendente',
            'status' => 'approved',
        ]);

        $this->actingAs($tutor)->get(route('clinicas.index'))
            ->assertOk()
            ->assertSee('Clinica Pendente');

        $this->actingAs($clinicUser)->post(route('clinicas.profile.update'), [
            'nome' => 'Clinica Nova',
            'tipo' => 'Hospital veterinario',
            'telefone' => '(11) 5555-6666',
            'email' => 'novo@clinica.test',
            'cidade' => 'Campinas',
            'uf' => 'SP',
            'descricao' => 'Versao pendente',
        ])->assertRedirect(route('clinicas.profile'));

        $clinica->refresh();
        $this->assertSame('Clinica Pendente', $clinica->nome);
        $this->assertSame('Clinica Nova', $clinica->pending_changes['nome']);

        $this->actingAs($tutor)->get(route('clinicas.index'))
            ->assertOk()
            ->assertSee('Clinica Pendente')
            ->assertDontSee('Clinica Nova');

        $this->actingAs($admin)->post(route('admin.clinicas.approve', $clinica))
            ->assertRedirect(route('admin.clinicas.index'));

        $this->assertDatabaseHas('clinicas', [
            'nome' => 'Clinica Nova',
            'status' => 'approved',
            'pending_changes' => null,
        ]);
    }

    public function test_vet_queue_accept_refuse_chat_and_finish_flow(): void
    {
        Storage::fake('public');

        $tutor = User::factory()->create([
            'tipo' => 'tutor',
            'cidade' => 'Sao Paulo',
            'uf' => 'SP',
        ]);
        $vetOne = User::factory()->create(['tipo' => 'vet']);
        $vetTwo = User::factory()->create(['tipo' => 'vet']);

        $animal = Animal::create([
            'id_usuario' => $tutor->id,
            'nome' => 'Mel',
            'especie' => 'Cao',
            'porte' => 'pequeno',
        ]);

        $this->actingAs($tutor)->post(route('atendimentos.store'), [
            'animal_id' => $animal->id,
            'modo' => 'video',
            'descricao' => 'Esta tossindo desde ontem',
        ])->assertRedirect();

        $atendimento = Atendimento::firstOrFail();
        $this->assertSame('aguardando', $atendimento->status);

        $this->actingAs($vetOne)->post(route('vet.disponibilidade'), [
            'disponivel_atendimento' => 1,
        ])->assertRedirect(route('vet.atendimentos.index'));

        $this->get(route('vet.atendimentos.index'))
            ->assertOk()
            ->assertSee('Mel')
            ->assertSee('Esta tossindo desde ontem');

        $this->post(route('atendimentos.refuse', $atendimento))
            ->assertRedirect(route('vet.atendimentos.index'));

        $atendimento->refresh();
        $this->assertContains($vetOne->id, $atendimento->recusado_por);

        $this->get(route('vet.atendimentos.index'))
            ->assertOk()
            ->assertDontSee('Mel');

        $this->actingAs($vetTwo)->post(route('vet.disponibilidade'), [
            'disponivel_atendimento' => 1,
        ])->assertRedirect(route('vet.atendimentos.index'));

        $this->post(route('atendimentos.accept', $atendimento))
            ->assertRedirect(route('atendimentos.show', $atendimento));

        $atendimento->refresh();
        $this->assertSame('em_atendimento', $atendimento->status);
        $this->assertSame($vetTwo->id, $atendimento->veterinario_id);

        $this->actingAs($tutor)->post(route('atendimentos.messages', $atendimento), [
            'mensagem' => 'Ele esta respirando normal agora',
        ])->assertRedirect(route('atendimentos.show', $atendimento).'#chat');

        $this->actingAs($vetTwo)->post(route('atendimentos.messages', $atendimento), [
            'mensagem' => 'Vou orientar os proximos passos',
        ])->assertRedirect(route('atendimentos.show', $atendimento).'#chat');

        $this->assertDatabaseHas('messages', [
            'atendimento_id' => $atendimento->id,
            'mensagem' => 'Vou orientar os proximos passos',
        ]);

        $file = UploadedFile::fake()->create('receita.pdf', 20, 'application/pdf');

        $this->actingAs($vetTwo)->post(route('atendimentos.finish', $atendimento), [
            'video_url' => 'https://meet.google.com/teste-vet',
            'descricao_observado' => 'Quadro leve, sem sinais de urgencia.',
            'anotacoes' => 'Observar por 24 horas.',
            'receita' => $file,
        ])->assertRedirect(route('atendimentos.show', $atendimento));

        $atendimento->refresh();
        $this->assertSame('finalizado', $atendimento->status);
        $this->assertNotNull($atendimento->receita_path);
        Storage::disk('public')->assertExists($atendimento->receita_path);

        $this->actingAs($tutor)->get(route('atendimentos.show', $atendimento))
            ->assertOk()
            ->assertSee('Quadro leve, sem sinais de urgencia.')
            ->assertSee('Observar por 24 horas.');

        $this->assertSame(2, Message::where('atendimento_id', $atendimento->id)->count());
    }
}
