<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuzzlesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('puzzles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('shortDescription');
            $table->text('description');
            $table->integer('timeLimit');
            $table->timestamps();
        });

        DB::table('puzzles')->insert([
          'id' => 1,
          'shortDescription' => 'Print Hello World!',
          'description' => 'Given any input, print <code>Hello World!</code>',
          'timeLimit' => 1,
        ]);

        DB::table('puzzles')->insert([
          'id' => 2,
          'shortDescription' => 'Multiply by two',
          'description' => 'Given any input, multiply the input by two and write to standard output.',
          'timeLimit' => 1,
        ]);

        DB::table('puzzles')->insert([
          'id' => 3,
          'shortDescription' => 'Find Prime Numbers',
          'description' => 'Given any input, determine if the number is prime. Output, to standard output, <out>0</out> if it is non-prime and <out>1</out> if it is prime.',
          'timeLimit' => 2,
        ]);

        DB::table('puzzles')->insert([
          'id' => 4,
          'shortDescription' => 'Unique Numbers',
          'description' => 'Given a list of space separated numbers, return the number of unique numbers. <br>
<h3>Input</h3>
First passed an integer <var>n</var>, followed by a list of <var>n</var> integers ranging from <var>0</var> to <var>10000</var>.
<h3>Output</h3>
A number representing how many unique integers were present in the input list.
<h3>Examples</h3>
<h4>Input 1</h4>
<pre>10
6 6 3 10 8 7 6 10 4 8</pre>
<h4>Output 1</h4>
<pre>6</pre>
<h4>Input 2</h4>
<pre>12
1 4 9 6 3 9 1 7 9 4 1 5</pre>
<h4>Output 2</h4>
<pre>7</pre>',
          'timeLimit' => 2,
        ]);

        DB::table('puzzles')->insert([
          'id' => 5,
          'shortDescription' => 'Placeholder 1',
          'description' => "Placeholder puzzle. Just output '1' to pass.",
          'timeLimit' => 1,
        ]);

        DB::table('puzzles')->insert([
          'id' => 6,
          'shortDescription' => 'Placeholder 2',
          'description' => "Placeholder puzzle. Just output '1' to pass.",
          'timeLimit' => 1,
        ]);

        DB::table('puzzles')->insert([
          'id' => 7,
          'shortDescription' => 'NICO NICO NII',
          'description' => "<img src='https://i.kym-cdn.com/photos/images/newsfeed/001/154/184/151'>
You nico nico need to add more nico to µ's music!
Given an entire lyrics of a µ's song, replace all instances of the syllable 'ni' with 'NICO NICO NII'.
However, with each 'NICO NICO NII' you add, you must lengthen the nico nico nii's with an additional 'I'.",
          'timeLimit' => 1,
        ]);

        DB::table('puzzles')->insert([
          'id' => 8,
          'shortDescription' => 'Go Skiing!',
          'description' => "Sometimes it's nice to take a break and code up a solution to a small, fun problem. Here is one some of our engineers enjoyed recently. It's called Skiing In Singapore.

Well you can’t really ski in Singapore. But let’s say you hopped on a flight to the Niseko ski resort in Japan. Being a software engineer you can’t help but value efficiency, so naturally you want to ski as long as possible and as fast as possible without having to ride back up on the ski lift. So you take a look at the map of the mountain and try to find the longest ski run down.

In digital form the map looks like the number grid below.

4 4
4 8 7 3
2 5 9 3
6 3 2 5
4 4 1 6

The first line (4 4) indicates that this is a 4x4 map. Each number represents the elevation of that area of the mountain. From each area (i.e. box) in the grid you can go north, south, east, west - but only if the elevation of the area you are going into is less than the one you are in. I.e. you can only ski downhill. You can start anywhere on the map and you are looking for a starting point with the longest possible path down as measured by the number of boxes you visit. And if there are several paths down of the same length, you want to take the one with the steepest vertical drop, i.e. the largest difference between your starting elevation and your ending elevation.

On this particular map the longest path down is of length=5 and it’s highlighted in bold below: 9-5-3-2-1.

4 4
4 8 7 3
2 5 9 3
6 3 2 5
4 4 1 6

There is another path that is also length five: 8-5-3-2-1. However the tie is broken by the first path being steeper, dropping from 9 to 1, a drop of 8, rather than just 8 to 1, a drop of 7.

Your challenge is to write a program in your favorite programming language to find the longest (and then steepest) path on this map specified in the format above. It’s 1000x1000 in size, and all the numbers on it are between 0 and 1500.",
          'timeLimit' => '30',
        ]);

        DB::table('puzzles')->insert([
          'id' => 9,
          'shortDescription' => 'Men of Culture',
          'description' => "Why, you didn't expect a challenge from me, did you?
Since I've heard you're well versed in memes, I shall test you on the Men of Culture meme!
Given a sentence, simply output <out>1</out> if the sentence can be made into a Men of Culture meme, and <out>0</out> otherwise. Have fun!
          ",
          'timeLimit' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('puzzles');
    }
}
