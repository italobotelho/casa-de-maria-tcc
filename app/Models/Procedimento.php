<?php

// app/Models/Procedimento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Procedimento extends Model
{
    protected $primaryKey = 'pk_cod_proc'; // Adicionei a chave primária

    public $incrementing = true;

    protected $fillable = [
        'nome_proc',
        'descricao_proc',
        'tempo_proc',
        'fk_crm_med',
    ];

    protected $casts = [
        'tempo_proc' => 'string',
    ];

    public function getTempoProcAttribute($value)
    {
        return Carbon::createFromFormat('H:i', $value)->format('i:s');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'fk_crm_med', 'pk_crm_med');
    }

    public function medicos()
    {
        return $this->belongsToMany(Medico::class, 'procedimento_medico', 'fk_cod_proc', 'fk_crm_med');
    }
}