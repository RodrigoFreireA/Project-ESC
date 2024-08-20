<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcionario_id',
        'data',
        'horario_inicio',
        'horario_fim',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}

