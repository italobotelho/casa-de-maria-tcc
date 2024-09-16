<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('convenio', function (Blueprint $table) {
            $table->bigIncrements('pk_id_conv'); // Changed to unsignedInteger
            $table->string('nome_conv');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('convenio');
    }
};
