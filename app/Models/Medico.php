<?php

// app/Models/Medico.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medico';

    protected $primaryKey = 'pk_crm_med';

    protected $fillable = [
        'especialidade1_med',
        'especialidade2_med',
        'email_med',
        'uf_med',
        'telefone_med',
        'nome_med',
    ];
}
