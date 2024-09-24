<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
<<<<<<< HEAD
        Schema::create('convenios', function (Blueprint $table) {
            $table->BigIncrements('pk_id_conv');
            $table->string('ans_conv', 6);
            $table->string('nome_conv', 55);
=======
        Schema::create('convenio', function (Blueprint $table) {
            $table->bigIncrements('pk_id_conv'); // Changed to unsignedInteger
            $table->string('nome_conv');
          

>>>>>>> tela-busca

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('convenios');
    }
};
