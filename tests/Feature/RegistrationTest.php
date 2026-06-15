<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_tutor_registration_saves_profile_fields_normalized(): void
    {
        $response = $this->post(route('cadastro.post'), [
            'tipo' => 'tutor',
            'name' => 'Maria Silva',
            'email' => 'maria@example.com',
            'phone' => '(11) 98765-4321',
            'cpf' => '123.456.789-01',
            'cep' => '01311-000',
            'logradouro' => 'Av. Paulista',
            'numero' => '1000',
            'bairro' => 'Bela Vista',
            'cidade' => 'Sao Paulo',
            'uf' => 'sp',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => 'on',
        ]);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseHas('users', [
            'email' => 'maria@example.com',
            'tipo' => 'tutor',
            'phone' => '11987654321',
            'cpf' => '12345678901',
            'cep' => '01311000',
            'uf' => 'SP',
        ]);
    }

    public function test_veterinarian_registration_requires_crmv(): void
    {
        $response = $this->from(route('cadastro'))->post(route('cadastro.post'), [
            'tipo' => 'vet',
            'name' => 'Dr Teste',
            'email' => 'vet@example.com',
            'phone' => '(11) 98765-4321',
            'cpf' => '123.456.789-02',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => 'on',
        ]);

        $response->assertRedirect(route('cadastro'));
        $response->assertSessionHasErrors('crmv');
        $this->assertDatabaseMissing('users', ['email' => 'vet@example.com']);
    }

    public function test_clinic_registration_uses_own_form_and_redirects_to_profile(): void
    {
        $response = $this->post(route('clinicas.register.post'), [
            'name' => 'Responsavel Clinica',
            'email' => 'clinica@example.com',
            'phone' => '(11) 3333-4444',
            'cnpj' => '12.345.678/0001-99',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => 'on',
        ]);

        $response->assertRedirect(route('clinicas.profile'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'clinica@example.com',
            'tipo' => 'clinic',
            'phone' => '1133334444',
            'cnpj' => '12345678000199',
        ]);
        $this->assertDatabaseCount('clinicas', 0);
    }

    public function test_general_registration_rejects_clinic_type(): void
    {
        $response = $this->from(route('cadastro'))->post(route('cadastro.post'), [
            'tipo' => 'clinic',
            'name' => 'Clinica Errada',
            'email' => 'errada@example.com',
            'phone' => '(11) 3333-4444',
            'cpf' => '123.456.789-03',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => 'on',
        ]);

        $response->assertRedirect(route('cadastro'));
        $response->assertSessionHasErrors('tipo');
        $this->assertDatabaseMissing('users', ['email' => 'errada@example.com']);
    }
}
