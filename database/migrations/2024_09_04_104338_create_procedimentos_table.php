<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Execute as migrações.
     */
    public function up(): void
    {
        Schema::create('procedimentos', function (Blueprint $table) {
            $table->increments('pk_cod_proc');
            $table->unsignedInteger('fk_crm_med');
            $table->foreign('fk_crm_med')->references('pk_crm_med')->on('medico');
<<<<<<< HEAD
            $table->string('descricao_proc', 100);
            $table->time('tempo_proc');
            $table->string('nome_proc', 50);
            $table->timestamps();

            Schema::dropIfExists('procedimentos');
=======
            $table->string('descricao_proc', 100); // Corrija o nome da coluna se for 'descricao_proc' em vez de 'descrição_proc'
            $table->time('tempo_proc');
            $table->string('nome_proc', 50);
            $table->timestamps();
>>>>>>> tela-busca
        });
    }

    /**
     * Reverta as migrações.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedimentos');
    }
};
