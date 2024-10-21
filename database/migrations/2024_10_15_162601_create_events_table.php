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
        Schema::create('events', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('color', 7);
            $table->unsignedBigInteger('procedimento_id'); // Adiciona a chave estrangeira

            $table->foreign('procedimento_id')->references('pk_cod_proc')->on('procedimentos'); // Define a relação

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['procedimento_id']); // Remove a chave estrangeira
        });
        Schema::dropIfExists('events');
    }
};