<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'descricao', 'data_id'
    ];

    // Relacionamento com Escalas
    public function escala()
    {
        return $this->belongsTo(Escalas::class, 'data_id', 'data_id');
    }
}

?>