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
        Schema::create('paciente', function (Blueprint $table) {
            $table->increments('pk_cod_paci'); // Chave primária auto-incrementada

            // Definir fk_cidade como unsignedInteger para corresponder ao tipo de pk_ende_paci
            $table->unsignedInteger('fk_cidade');
            $table->foreign('fk_cidade')->references('pk_ende_paci')->on('cidade');

            // Definir fk_convenio_paci como unsignedInteger para garantir compatibilidade
            $table->unsignedInteger('fk_convenio_paci');
            $table->foreign('fk_convenio_paci')->references('pk_nome_conv')->on('convenio');

            // Campos adicionais
            $table->string('email_paci', 255)->nullable();
            $table->dateTime('data_obito_paci')->nullable();
            $table->string('carteira_convenio_paci', 20)->nullable();
            $table->string('responsavel_paci', 50)->nullable();
            $table->dateTime('data_nasci_paci')->nullable();
            $table->string('nome_paci', 54)->nullable();
            $table->string('cpf_responsavel_paci', 11)->nullable();
            $table->string('telefone_paci', 12)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverta as migrações.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente');
    }
};
