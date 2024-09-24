<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    // Define a tabela associada a este modelo
    protected $table = 'cidade';

    // Define a chave primária da tabela
    protected $primaryKey = 'pk_ende_paci';

    // Diz ao Laravel que a chave primária é do tipo inteiro
    protected $keyType = 'int';

    // Desativa o incremento automático da chave primária
    public $incrementing = true;

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome_cidade',
        
        // outros campos
    ];

    // Relacionamento com a tabela Pacientes
    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'fk_cidade');
    }
}
