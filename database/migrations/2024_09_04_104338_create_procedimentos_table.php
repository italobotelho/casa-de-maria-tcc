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
            $table->id('pk_cod_proc');
            $table->string('descricao_proc', 100);
            $table->string('nome_proc', 50);
            $table->timestamps();
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