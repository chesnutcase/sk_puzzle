<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestCasesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('test_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->text('input')->nullable();
            $table->text('output');
            $table->unsignedInteger('puzzle_id');
            $table->foreign('puzzle_id')->references('id')->on('puzzles');
            $table->timestamps();
        });

        DB::table('test_cases')->insert([
          'input' => '',
          'output' => 'Hello World!',
          'puzzle_id' => 1,
        ]);

        DB::table('test_cases')->insert([
          'input' => 0,
          'output' => 0,
          'puzzle_id' => 2,
        ]);

        DB::table('test_cases')->insert([
          'input' => 1,
          'output' => 2,
          'puzzle_id' => 2,
        ]);

        DB::table('test_cases')->insert([
          'input' => 2,
          'output' => 4,
          'puzzle_id' => 2,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('test_cases');
    }
}
