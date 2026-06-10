<?php

namespace Database\Seeders;

use App\Models\Clinica;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'tipo' => 'tutor',
            ]
        );

        collect([
            [
                'nome' => 'VetTech Centro Clinico',
                'tipo' => 'Clinica veterinaria',
                'telefone' => '11987654321',
                'email' => 'contato@vettechcentro.test',
                'cep' => '01311000',
                'logradouro' => 'Av. Paulista',
                'numero' => '1000',
                'bairro' => 'Bela Vista',
                'cidade' => 'Sao Paulo',
                'uf' => 'SP',
                'distancia' => 1.20,
                'nota' => 4.8,
                'aberta_agora' => true,
                'horario_abertura' => '08:00',
                'descricao' => 'Atendimento clinico, vacinas e exames de rotina.',
                'telemedicina' => true,
            ],
            [
                'nome' => 'Pet Care 24h',
                'tipo' => 'Hospital veterinario',
                'telefone' => '1133334444',
                'email' => 'emergencia@petcare24.test',
                'cep' => '04001000',
                'logradouro' => 'Rua Vergueiro',
                'numero' => '540',
                'bairro' => 'Liberdade',
                'cidade' => 'Sao Paulo',
                'uf' => 'SP',
                'distancia' => 2.70,
                'nota' => 4.6,
                'aberta_agora' => true,
                'horario_abertura' => '24h',
                'descricao' => 'Emergencia, internacao e cirurgias.',
                'telemedicina' => false,
            ],
            [
                'nome' => 'Clinica Amigo Pet Online',
                'tipo' => 'Telemedicina veterinaria',
                'telefone' => '1144445555',
                'email' => 'online@amigopet.test',
                'cidade' => 'Online',
                'uf' => 'BR',
                'distancia' => 0,
                'nota' => 4.9,
                'aberta_agora' => true,
                'horario_abertura' => '24h online',
                'descricao' => 'Consultas online para orientacao inicial e retorno.',
                'telemedicina' => true,
            ],
        ])->each(fn (array $clinica) => Clinica::updateOrCreate(
            ['nome' => $clinica['nome']],
            $clinica
        ));
    }
}
