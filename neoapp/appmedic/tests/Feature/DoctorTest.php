<?php

namespace Tests\Feature;

use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_doctor_index(): void
    {
        $response = $this->getJson('/api/doctor');
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'crm',
                ]
            ]);
    }

    public function test_doctor_show(): void
    {
        $response = $this->getJson('/api/doctor/3');

        $response->assertStatus(200);
    }

    public function test_doctor_create(): void
    {
        $data = [
            'name' => 'Felipe',
            'crm' => '12345',
        ];
        $response = $this->postJson('/api/doctor', $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'crm',
            ])
            ->assertJson([
                'name' => 'Felipe',
                'crm' => '12345',
            ]);
        $this->assertDatabaseHas('doctor', [
            'name' => 'Felipe',
            'crm' => '12345',
        ]);
    }

    public function test_doctor_update(): void
    {
        // Cria um médico no banco de dados para ser atualizado
        $doctor = Doctor::factory()->create();

        // Dados simulados para a atualização do médico
        $updatedData = [
            'name' => 'Felipe Santos',
            'crm' => '54321',
            // Adicione outros campos que você deseja atualizar
        ];

        // Faz uma requisição PUT para a rota específica do médico
        $response = $this->putJson("/api/doctor/{$doctor->id}", $updatedData);

        // Verifica se a resposta tem o status 200 OK
        $response->assertStatus(200)
            // Verifica se a resposta contém a mensagem esperada
            ->assertJson(['message' => 'Doctor updated.']);

        // Atualiza o modelo do médico no banco de dados
        $doctor->refresh();

        // Verifica se os dados foram atualizados corretamente
        $this->assertEquals('Felipe Santos', $doctor->name);
        $this->assertEquals('54321', $doctor->crm);
        // Adicione outras verificações conforme necessário
    }
}
