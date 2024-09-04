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
        Schema::create('procedimentos', function (Blueprint $table) {
            $table->integer('pk_cod_proc')->primary();
            $table->integer('fk_crm_med');
            $table->foreign('fk_crm_med')->references('pk_crm_med')->on('medico');
            $table->string('descrição_proc', 100);
            $table->dateTime('tempo_proc');
            $table->string('nome_proc', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedimentos');
    }
};
