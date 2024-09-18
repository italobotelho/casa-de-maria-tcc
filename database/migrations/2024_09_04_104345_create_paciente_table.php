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
            $table->increments('pk_cod_paci');

            $table->unsignedBigInteger('fk_convenio_paci');
            $table->foreign('fk_convenio_paci')->references('pk_id_conv')->on('convenios')->onDelete('cascade');

            $table->string('email_paci', 255)->nullable();
            $table->dateTime('data_obito_paci')->nullable();
            $table->string('carteira_convenio_paci', 20)->nullable();
            $table->string('responsavel_paci', 50)->nullable();
            $table->dateTime('data_nasci_paci')->nullable();
            $table->string('nome_paci', 54)->nullable();
            $table->string('cpf_responsavel_paci', 11)->nullable();
            $table->string('cpf_paci', 11)->nullable();
            $table->string('nome_cidade', 100)->nullable();
            $table->string('telefone_paci', 12)->nullable();
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
