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
            $table->bigInteger('cnpj_clin')->primary();
            $table->string('nome_clin', 25);
            $table->string('descricao_clin', 100);
            $table->string('telefone_clin', 12);
            $table->string('email_aten_clin', 255);
            $table->string('email_resp_clin', 255);
            $table->string('cep_clin', 8);
            $table->string('rua_clin', 17);
            $table->string('numero_clin', 5);
            $table->string('bairro_clin', 50);
            $table->string('complemento_clin', 100);
            $table->string('cidade_clin', 30);
            $table->string('uf_clin', 2);
            $table->bigInteger('cod_ibge_clin');
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