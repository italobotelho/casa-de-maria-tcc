<?php

// app/Models/Procedimento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    protected $primaryKey = 'pk_cod_proc'; // Adicionei a chave primária

    protected $fillable = [
        'nome_proc',
        'descricao_proc',
        'tempo_proc',
        'fk_crm_med',
    ];

    protected $casts = [
        'tempo_proc' => 'time:H:i:s',
    ];

    public function getTempoProcAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i:s');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'fk_crm_med', 'pk_crm_med');
    }
}