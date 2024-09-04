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
        Schema::create('clinica', function (Blueprint $table) {
            $table->integer('pk_cnpj')->primary();
            $table->string('nome_clin', 25);
            $table->string('email_aten_clin', 255);
            $table->string('numero_clin', 5);
            $table->string('rua_clin', 17);
            $table->string('telefone_clin', 12);
            $table->string('email_resp_clin', 255);
            $table->string('cidade_clin', 30);
            $table->string('descriçõ_clin', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinica');
    }
};
