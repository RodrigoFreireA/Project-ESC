<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escalas extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcionario_id', 'horario_inicio', 'horario_fim', 'recorrente', 'data', 'data_id', 'observacoes'
    ];

    // Relacionamento com Funcionario
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    // Relacionamento com Eventos
    public function eventos()
    {
        return $this->hasMany(Eventos::class, 'data_id', 'data_id');
    }
}

?>
