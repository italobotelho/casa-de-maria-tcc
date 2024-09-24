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
            $table->integer('pk_cod_proc')->primary();
            $table->unsignedInteger('fk_crm_med'); // Garanta que o tipo de dado corresponde à chave primária na tabela 'medico'
            $table->foreign('fk_crm_med')->references('pk_crm_med')->on('medico');
            $table->string('descricao_proc', 100); // Corrija o nome da coluna se for 'descricao_proc' em vez de 'descrição_proc'
            $table->dateTime('tempo_proc');
            $table->string('nome_proc', 50);
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
