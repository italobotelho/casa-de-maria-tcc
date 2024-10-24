<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('color', 7);
            $table->unsignedBigInteger('procedimento_id'); // Foreign key
            $table->unsignedInteger('medico'); // Changed to unsignedInteger
            $table->unsignedBigInteger('convenio');
            
            $table->foreign('procedimento_id')->references('pk_cod_proc')->on('procedimentos');
            $table->foreign('medico')->references('pk_crm_med')->on('medicos');
            $table->foreign('convenio')->references('pk_id_conv')->on('convenios');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['procedimento_id']);
            $table->dropForeign(['medico']);
            $table->dropForeign(['convenio']);
        });
        Schema::dropIfExists('events');
    }
};
