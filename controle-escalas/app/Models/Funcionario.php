<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'tipo_escala', 'localizacao', 'unidade_atendida'];

    public function escalas()
    {
        return $this->hasMany(Escala::class);
    }
}
