<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attempt_id');
            $table->foreign('attempt_id')->references('id')->on('attempts');
            $table->unsignedInteger('test_case_id')->nullable();
            $table->foreign('test_case_id')->references('id')->on('test_cases');
            $table->text('verdict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
