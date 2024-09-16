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
        Schema::create('clinicas', function (Blueprint $table) {
            $table->bigInteger('cnpj')->primary();
            $table->string('nome', 25);
            $table->string('descricao', 100);
            $table->string('telefone', 12);
            $table->string('email_aten', 255);
            $table->string('email_resp', 255);
            $table->string('cep', 8);
            $table->string('rua', 17);
            $table->string('numero', 5);
            $table->string('bairro', 50);
            $table->string('complemento', 100);
            $table->string('cidade', 30);
            $table->string('uf', 2);
            $table->bigInteger('cod_ibge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinicas');
    }
};