<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcionario_id',        
        'horario_inicio',
        'horario_fim',
        'recorrente',
        'data',
        'dias',
        'observacoes', // Adicione aqui
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}

