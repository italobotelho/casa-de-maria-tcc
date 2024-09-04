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
        Schema::create('paciente', function (Blueprint $table) {
            $table->integer('pk_cod_paci')->primary();
            $table->integer('fk_cidade');
            $table->foreign('fk_cidade')->references('pk_ende_paci')->on('cidade');
            $table->integer('fk_convenio_paci');
            $table->foreign('fk_convenio_paci')->references('pk_ans_conv')->on('convenio');
            $table->string('convenio_paci', 50);
            $table->string('email_paci', 255);
            $table->dateTime('data_obito_paci')->nullable();
            $table->string('carteira_convenio_paci', 20);
            $table->string('responsavel_paci', 50);
            $table->dateTime('data_nasci_paci');
            $table->string('nome_paci', 54);
            $table->string('cpf_responsavel_paci', 11);
            $table->string('telefone_paci', 12);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente');
    }
};
