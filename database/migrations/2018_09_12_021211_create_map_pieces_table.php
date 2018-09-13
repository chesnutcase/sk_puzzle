<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapPiecesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('map_pieces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('puzzle_id');
            $table->foreign('puzzle_id')->references('id')->on('puzzles');
            $table->string('imagePath');
            $table->timestamps();
        });
        for ($i = 1; $i <= 9; ++$i) {
            DB::table('map_pieces')->insert([
            'puzzle_id' => $i,
            'imagePath' => '/img/default_map_'.$i.'.png',
          ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('map_pieces');
    }
}
