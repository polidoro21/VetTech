<?php

namespace Tests\Feature;

use App\Models\Animal;
use App\Models\Clinica;
use App\Models\Consulta;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerModulesTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_dashboard_and_main_pages_render(): void
    {
        $user = User::factory()->create();
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
            'telemedicina' => true,
        ]);

        foreach ([
            route('dashboard'),
            route('animais.index'),
            route('animais.create'),
            route('consultas.index'),
            route('consultas.create'),
            route('atendimentos.index'),
            route('atendimentos.create'),
            route('vacinas.index'),
            route('clinicas.index'),
            route('telemedicina.index'),
            route('chat'),
        ] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_detail_pages_render_for_owned_records(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $animal = Animal::create([
            'id_usuario' => $user->id,
            'nome' => 'Bento',
            'especie' => 'Cao',
            'porte' => 'medio',
        ]);

        $clinica = Clinica::create([
            'nome' => 'Clinica Detalhe',
            'cidade' => 'Sao Paulo',
            'uf' => 'SP',
            'telemedicina' => true,
        ]);

        $consulta = Consulta::create([
            'user_id' => $user->id,
            'animal_id' => $animal->id,
            'clinica_id' => $clinica->id,
            'tipo' => 'online',
            'data' => now()->addDay()->toDateString(),
            'hora' => '11:00',
            'status' => 'agendada',
            'sala_url' => route('telemedicina.sala', 1),
        ]);

        $consulta->update(['sala_url' => route('telemedicina.sala', $consulta->id)]);

        foreach ([
            route('animais.show', $animal),
            route('animais.edit', $animal),
            route('clinicas.show', $clinica),
            route('consultas.show', $consulta),
            route('telemedicina.sala', $consulta),
        ] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_animal_crud_is_limited_to_authenticated_user(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('animais.store'), [
            'nome' => 'Thor',
            'especie' => 'Cao',
            'raca' => 'SRD',
            'porte' => 'medio',
            'cor' => 'Caramelo',
        ])->assertRedirect(route('animais.index'));

        $animal = Animal::where('id_usuario', $user->id)->firstOrFail();
        $this->assertDatabaseHas('animais', ['id' => $animal->id, 'nome' => 'Thor']);

        $this->put(route('animais.update', $animal), [
            'nome' => 'Thor Junior',
            'especie' => 'Cao',
            'porte' => 'grande',
        ])->assertRedirect(route('animais.index'));

        $this->assertDatabaseHas('animais', ['id' => $animal->id, 'nome' => 'Thor Junior']);

        $otherAnimal = Animal::create([
            'id_usuario' => $other->id,
            'nome' => 'Nina',
            'especie' => 'Gato',
            'porte' => 'pequeno',
        ]);

        $this->get(route('animais.show', $otherAnimal))->assertNotFound();

        $this->delete(route('animais.destroy', $animal))->assertRedirect(route('animais.index'));
        $this->assertDatabaseMissing('animais', ['id' => $animal->id]);
    }

    public function test_vaccines_consultations_atendimentos_telemedicine_and_chat_persist(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $animal = Animal::create([
            'id_usuario' => $user->id,
            'nome' => 'Mel',
            'especie' => 'Cao',
            'porte' => 'pequeno',
        ]);

        $clinica = Clinica::create([
            'nome' => 'Vet Online',
            'cidade' => 'Online',
            'uf' => 'BR',
            'telemedicina' => true,
        ]);

        $this->post(route('vacinas.store'), [
            'animal_id' => $animal->id,
            'nome' => 'Antirrabica',
            'data_aplicacao' => now()->toDateString(),
            'proxima_dose' => now()->addYear()->toDateString(),
        ])->assertRedirect(route('vacinas.index'));

        $this->post(route('consultas.store'), [
            'animal_id' => $animal->id,
            'clinica_id' => $clinica->id,
            'tipo' => 'presencial',
            'data' => now()->addDay()->toDateString(),
            'hora' => '10:00',
        ])->assertRedirect(route('consultas.index'));

        $this->post(route('atendimentos.store'), [
            'animal_id' => $animal->id,
            'data' => now()->toDateString(),
            'descricao' => 'Check-up',
            'valor' => 150,
            'status' => 'atendido',
        ])->assertRedirect(route('atendimentos.index'));

        $this->post(route('telemedicina.store'), [
            'animal_id' => $animal->id,
            'clinica_id' => $clinica->id,
            'data' => now()->addDays(2)->toDateString(),
            'hora' => '14:30',
        ])->assertRedirect(route('telemedicina.index'));

        $this->post(route('chat.send'), [
            'mensagem' => 'Preciso de ajuda',
        ])->assertRedirect(route('chat'));

        $this->assertDatabaseHas('vacinas', ['animal_id' => $animal->id, 'nome' => 'Antirrabica']);
        $this->assertDatabaseHas('consultas', ['animal_id' => $animal->id, 'tipo' => 'presencial']);
        $this->assertDatabaseHas('consultas', ['animal_id' => $animal->id, 'tipo' => 'online']);
        $this->assertDatabaseHas('atendimentos', ['animal_id' => $animal->id, 'status' => 'atendido']);
        $this->assertDatabaseHas('messages', ['user_id' => $user->id, 'mensagem' => 'Preciso de ajuda']);
    }
}
