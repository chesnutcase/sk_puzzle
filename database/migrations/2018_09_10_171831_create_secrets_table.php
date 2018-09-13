<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecretsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('secrets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 50)->unique();
            $table->text('value');
            $table->timestamps();
        });
        DB::table('secrets')->insert([
          'key' => 'sk_key',
          'value' => bcrypt('birthday'),
        ]);
        DB::table('secrets')->insert([
          'key' => 'admin_key',
          'value' => bcrypt('present'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('secrets');
    }
}
