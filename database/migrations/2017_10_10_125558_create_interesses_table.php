<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->nullable(false);
            $table->string('telefone')->nullable(true);
            $table->string('email')->nullable(true);
            $table->boolean('atendido')->nullable(false)->default(false);
            $table->integer('id_imovel', false, true);
            $table->timestamps();

            $table->foreign('id_imovel')->references('id')->on('imoveis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interesses');
    }
}
