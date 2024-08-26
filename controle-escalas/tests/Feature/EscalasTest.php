<?php
namespace Tests\Feature;

use App\Models\Escalas;
use App\Models\Funcionario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EscalasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_new_escala()
    {
        // Criação de um funcionário para associar à escala
        $funcionario = Funcionario::factory()->create();

        $response = $this->post('/escalas', [
            'funcionario_id' => $funcionario->id,
            'horario_inicio' => '08:00:00',
            'horario_fim' => '17:00:00',
            'recorrente' => 0,
            'data' => '2024-08-23',
            'data_id' => '20240823',
            'observacoes' => 'Escala para evento especial',
        ]);

        $response->assertStatus(302); // Verifica se redirecionou corretamente
        $this->assertDatabaseHas('escalas', [
            'funcionario_id' => $funcionario->id,
            'horario_inicio' => '08:00:00',
            'data_id' => '20240823',
        ]);
    }

    /** @test */
    public function it_updates_an_existing_escala()
    {
        $escala = Escalas::factory()->create();

        $response = $this->put("/escalas/{$escala->id}", [
            'horario_inicio' => '09:00:00', // Alterando o horário
            'horario_fim' => $escala->horario_fim,
            'recorrente' => $escala->recorrente,
            'data' => $escala->data,
            'data_id' => $escala->data_id,
            'observacoes' => $escala->observacoes,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('escalas', [
            'id' => $escala->id,
            'horario_inicio' => '09:00:00',
        ]);
    }

    /** @test */
    public function it_deletes_an_escala()
    {
        $escala = Escalas::factory()->create();

        $response = $this->delete("/escalas/{$escala->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('escalas', [
            'id' => $escala->id,
        ]);
    }
}

