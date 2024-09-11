<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('convenio', function (Blueprint $table) {
            $table->unsignedInteger('pk_nome_conv')->primary(); // Changed to unsignedInteger
            $table->string('ans_conv');
            $table->dateTime('retorno_conv');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('convenio');
    }
};
