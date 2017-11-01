<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero', false, true)->nullable(true);
            $table->double('valor')->nullable(true);
            $table->integer('dormitorio', false, true)->nullable(true);
            $table->integer('suite', false, true)->nullable(true);
            $table->integer('banheiro', false, true)->nullable(true);
            $table->integer('garagem', false, true)->nullable(true);
            $table->boolean('mobilia')->nullable(true);
            $table->boolean('aservico')->nullable(true);
            $table->text('descricao')->nullable(false);
            $table->integer('aterreno', false, true)->nullable(true);
            $table->integer('aconstruida', false, true)->nullable(true);

            $table->integer('id_finalidade',false,true);
            $table->integer('id_tipo',false,true);
            $table->integer('id_rua',false,true);

            $table->foreign('id_finalidade')->references('id')->on('finalidades')->onDelete('cascade');
            $table->foreign('id_tipo')->references('id')->on('tipos')->onDelete('cascade');
            $table->foreign('id_rua')->references('id')->on('ruas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imoveis');
    }
}
