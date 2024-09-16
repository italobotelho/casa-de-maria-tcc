<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Builder\FallbackBuilder;

class Convenio extends Model
{
    use HasFactory;
      // Define a tabela associada a este modelo
      protected $table = 'convenio';

      // Define a chave primária da tabela
      protected $primaryKey = 'pk_id_paci';

      // Diz ao Laravel que a chave primária é do tipo inteiro
      protected $keyType = 'int';

      // Desativa o incremento automático da chave primária
      public $incrementing = false;

      // Define os campos que podem ser preenchidos em massa
      protected $fillable = [
          'pk_id_conv',
          'ans_conv',
          'retorno_conv'

          // outros campos
      ];

}
