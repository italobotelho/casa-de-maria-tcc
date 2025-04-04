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
            $table->string('descricao_proc', 100);
            $table->time('tempo_proc');
            $table->string('nome_proc', 50);
            $table->timestamps();

            Schema::dropIfExists('procedimentos');
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
