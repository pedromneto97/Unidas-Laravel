<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cep')->unique()->nullable(true);
            $table->string('rua')->nullable(false);
            $table->integer('id_bairro', false, true);

            $table->foreign('id_bairro')->references('id')->on('bairros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruas');
    }
}
