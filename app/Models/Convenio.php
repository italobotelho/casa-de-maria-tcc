<?php

// app/Models/Convenio.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $table = 'convenios';

    protected $fillable = [
        'pk_cod_conv',
        'ans_conv',
        'nome_conv',
    ];
}
