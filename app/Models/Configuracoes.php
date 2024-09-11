<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracoes extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'descricao',
        'telefone_recepcao',
        'email_atendimento_clinica',
        'email_responsavel_clinica',
        'cep',
        'logradouro',
        'numero_estabelecimento',
        'bairro',
        'complemento',
        'cidade',
        'uf',
        'cod_ibge',
    ];

    protected $primaryKey = 'pk_cnpj';
}
