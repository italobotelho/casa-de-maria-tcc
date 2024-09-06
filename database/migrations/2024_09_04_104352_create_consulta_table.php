<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->unsignedInteger('pk_id_cons')->primary(); // Use o tipo adequado para a chave primária
            $table->unsignedInteger('fk_cod_paci'); // Altere para o mesmo tipo de dado da chave primária na tabela 'paciente'
            $table->foreign('fk_cod_paci')->references('pk_cod_paci')->on('paciente');
            $table->unsignedInteger('fk_crm_med'); // Altere para o mesmo tipo de dado da chave primária na tabela 'medico'
            $table->foreign('fk_crm_med')->references('pk_crm_med')->on('medico');
            $table->dateTime('dia_cons');
            $table->dateTime('mes_cons');
            $table->dateTime('ano_cons');
            $table->string('profissional_cons', 50);
            $table->string('horario_cons', 10);
            $table->string('paciente_cons', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consulta');
    }
};
