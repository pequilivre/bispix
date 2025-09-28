<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndiceTable extends Migration
{
    public function up()
    {
        Schema::create('indice', function(Blueprint $table)
        {
            $table
                ->increments('id');
            $table
                ->string('termo','100');
            $table
                ->string('documento','2');
            $table
                ->integer('posicao');
            $table
                ->unique( array('documento', 'posicao') );
            $table
                ->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indice');
    }
}
