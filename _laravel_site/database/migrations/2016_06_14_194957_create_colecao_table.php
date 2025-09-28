<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColecaoTable extends Migration
{
    public function up()
    {
        Schema::create('colecao', function(Blueprint $table)
        {
            $table
                ->increments('id');
            $table
                ->string('nome','100');
            $table
                ->string('nome_seletor','100');
            $table
                ->string('endereco','100');
            $table
                ->boolean('em_uso');
            $table
                ->unique( 'nome_seletor' );
            $table
                ->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colecao');
    }
}
