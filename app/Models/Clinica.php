<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'descricao',
        'telefone',
        'email_aten',
        'email_resp',
        'cep',
        'rua',
        'numero',
        'bairro',
        'complemento',
        'cidade',
        'uf',
        'cod_ibge',
    ];

    protected $primaryKey = 'cnpj';
}

