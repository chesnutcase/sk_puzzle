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
          'description' => <<<EOT
Given a list of space separated numbers, return the number of unique numbers. <br>
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
<pre>7</pre>
EOT
        ,
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
          'shortDescription' => 'Nico Nico Nii',
          'description' => <<<EOT
<p><img src='https://i.kym-cdn.com/photos/images/newsfeed/001/154/184/151'></p>
<p>You nico nico need to add more nico to µ's music!</p>
<p>Given the lyrics of a µ's song, replace all instances of the syllable <code>'ni'</code> with <code>'NICO NICO NII'</code>.
However, with each <code>'NICO NICO NII'</code> you add, you must lengthen subsequent nico nico nii's with an additional <code>'I'</code>.</p>
<h3>Input</h3>
The first line represents how many lines the lyrics have. Then, line by line, the lyrics will be passed, containing whitespace. You must use <code>getline</code> and <b>not</b> <code>cin</code> to read the end of the input to entirety. There will be no empty lines in the input. The lyrics are stripped of non-alphabetic characters other than whitespaces.
<h3>Output</h3>
The manipulated lyrics of the song. Each instance of <code>'ni'</code> must be replaced with <code>'NICO NICO NII'</code>, but each instance with an additional <code>'I'</code>.
<h3>Examples</h3>
<h4>Input 1</h4>
Not a µ's song, but for reference:
<pre>
1
nihao Nihao nihao
</pre>
<h4>Output 1</h4>
<pre>NICO NICO NIIhao Nihao NICO NICO NIIIhao</pre>
Note that the match is case-sensitive.
<h4>Input 2</h4>
Song: Aishiteru Banzai
<pre>
33
Aishiteru banzai
Koko de yokatta watashitachi no ima ga koko ni aru
Aishiteru banzai
Hajimatta bakari ashita mo yoroshiku ne mada gooru janai
Waratte yo kanashii nara fuki to basou yo
Waraetara kawaru keshiki harema ga nozoku
Fuan demo shiawase e to tsunagaru michi ga
Miete kita yo na aozora
Tokidoki ame ga furu kedo mizu ga nakucha taihen
Kawaicha dame da yo minna no yume no ki yo sodate
Saa
Daisuki da banzai
Makenai yuuki watashitachi wa ima o tanoshimou
Daisuki da banzai
Ganbareru kara kinou ni te o futte hora mae muite
Susunde yo kurushikute mo tonari ni ite yo
Susundara moeru taiyou higashi o terasu
Mayotteta kotae ga nai saki e no michi wa
Daremo shiranai ienai
Totsuzen arashi no naka e ochiru gin no hikari
Obiecha dame da yo minna no yume no ki wa tsuyoi
Saa
Aishiteru banzai
Koko de yokatta watashitachi no ima ga koko ni aru
Aishiteru banzai
Hajimatta bakari ashita mo yoroshiku ne mada gooru janai
Tokidoki ame ga furun da kaze de miki ga yureru
Issho ni ikun da minna no yume no ki yo sodate
Saa
Daisuki da banzai
Makenai yuuki watashitachi wa ima o tanoshimou
Daisuki da banzai
Ganbareru kara kinou ni te o futte hora mae muite
</pre>
<h4>Output 2</h4>
<pre>
Aishiteru banzai
Koko de yokatta watashitachi no ima ga koko NICO NICO NII aru
Aishiteru banzai
Hajimatta bakari ashita mo yoroshiku ne mada gooru janai
Waratte yo kanashii nara fuki to basou yo
Waraetara kawaru keshiki harema ga nozoku
Fuan demo shiawase e to tsunagaru michi ga
Miete kita yo na aozora
Tokidoki ame ga furu kedo mizu ga nakucha taihen
Kawaicha dame da yo minna no yume no ki yo sodate
Saa
Daisuki da banzai
Makenai yuuki watashitachi wa ima o tanoshimou
Daisuki da banzai
Ganbareru kara kinou NICO NICO NIII te o futte hora mae muite
Susunde yo kurushikute mo tonari NICO NICO NIIII ite yo
Susundara moeru taiyou higashi o terasu
Mayotteta kotae ga nai saki e no michi wa
Daremo shiranai ienai
Totsuzen arashi no naka e ochiru gin no hikari
Obiecha dame da yo minna no yume no ki wa tsuyoi
Saa
Aishiteru banzai
Koko de yokatta watashitachi no ima ga koko NICO NICO NIIIII aru
Aishiteru banzai
Hajimatta bakari ashita mo yoroshiku ne mada gooru janai
Tokidoki ame ga furun da kaze de miki ga yureru
Issho NICO NICO NIIIIII ikun da minna no yume no ki yo sodate
Saa
Daisuki da banzai
Makenai yuuki watashitachi wa ima o tanoshimou
Daisuki da banzai
Ganbareru kara kinou NICO NICO NIIIIIII te o futte hora mae muite
</pre>
<h4>Input 3</h4>
Song: Niko Puri ~ Joshidou
<pre>
51
Niko puri niko niko niko puri YEAH niko niko
Niko puri niko niko niko puri YEAH PuritiGIRL
Kimegao kibishiku tsuikyuu
Arittake no jounetsu o sasagete
Tadoritsuita raburii
Kansei sareta hohoemi
Nikoniko un Zettai makenai
Chiya hoya saretai dake ja
Kokoro zashi hiku sugiru ne hantaai
Todo no tsumari raburii
Kanpekina uinku miserun
Nikoniko un Saikou
Shiawase o todokemasho kono shunkan o
Niko niko no mirakuru
Kimari sugi YEAH YEAH
Pyon pyoko pyon pyon Kaawaii
Kaminoke ga hanete pyon pyoko
Ookiku maware niko niko todoke
Pyon pyoko pyon pyon Kaawaii
Kaminoke ga hanete pyon pyoko
Itasa mo honki warui ka honki sa
Sore ga niko no joshidou
Uru me de nagashime goukaku
Tobikkiri no aijou ageru wa
Koboresou na kyuutii
Mamoritaku naru hazu deshu
Nikoniko hai Touzen makenai
Dogi magi sasechau gomen
Miryokuteki sonna yadana shitteruu
Tomedonakute kyuutii
Ubaitaku naru kuchibiru
Nikoniko hai Kinshi
Shiawase o tsukamanakya sou jiriki de
Niko niko wa buki yo
Uwamuite YEAH YEAH
Pyon pyoko pyon pyon Chiicchai
Dakishimete mite yo pyon pyoko
Ooki na yume mo niko niko kanau
Pyon pyoko pyon pyon Chiicchai
Dakishimete mite yo pyon pyoko
Samukute joutou samuiko wa tsuyoi
Korezo niko no joshidou
Pyon pyoko pyon pyon Kaawaii
Kaminoke ga hanete pyon pyoko
Ookiku maware niko niko todoke
Pyon pyoko pyon pyon Kaawaii
Kaminoke ga hanete pyon pyoko
Itasa mo honki warui ka honki sa
Sore ga niko no joshidou
Niko puri niko niko niko puri YEAH niko niko
Niko puri niko niko niko puri YEAH PuritiGIRL
</pre>
<h4>Output 3</h4>
<pre>
Niko puri NICO NICO NIIko NICO NICO NIIIko NICO NICO NIIIIko puri YEAH NICO NICO NIIIIIko NICO NICO NIIIIIIko
Niko puri NICO NICO NIIIIIIIko NICO NICO NIIIIIIIIko NICO NICO NIIIIIIIIIko puri YEAH PuritiGIRL
Kimegao kibishiku tsuikyuu
Arittake no jounetsu o sasagete
Tadoritsuita raburii
Kansei sareta hohoemi
NikoNICO NICO NIIIIIIIIIIko un Zettai makenai
Chiya hoya saretai dake ja
Kokoro zashi hiku sugiru ne hantaai
Todo no tsumari raburii
Kanpekina uinku miserun
NikoNICO NICO NIIIIIIIIIIIko un Saikou
Shiawase o todokemasho kono shunkan o
Niko NICO NICO NIIIIIIIIIIIIko no mirakuru
Kimari sugi YEAH YEAH
Pyon pyoko pyon pyon Kaawaii
Kaminoke ga hanete pyon pyoko
Ookiku maware NICO NICO NIIIIIIIIIIIIIko NICO NICO NIIIIIIIIIIIIIIko todoke
Pyon pyoko pyon pyon Kaawaii
Kaminoke ga hanete pyon pyoko
Itasa mo honki warui ka honki sa
Sore ga NICO NICO NIIIIIIIIIIIIIIIko no joshidou
Uru me de nagashime goukaku
Tobikkiri no aijou ageru wa
Koboresou na kyuutii
Mamoritaku naru hazu deshu
NikoNICO NICO NIIIIIIIIIIIIIIIIko hai Touzen makenai
Dogi magi sasechau gomen
Miryokuteki sonna yadana shitteruu
Tomedonakute kyuutii
Ubaitaku naru kuchibiru
NikoNICO NICO NIIIIIIIIIIIIIIIIIko hai Kinshi
Shiawase o tsukamanakya sou jiriki de
Niko NICO NICO NIIIIIIIIIIIIIIIIIIko wa buki yo
Uwamuite YEAH YEAH
Pyon pyoko pyon pyon Chiicchai
Dakishimete mite yo pyon pyoko
Ooki na yume mo NICO NICO NIIIIIIIIIIIIIIIIIIIko NICO NICO NIIIIIIIIIIIIIIIIIIIIko kanau
Pyon pyoko pyon pyon Chiicchai
Dakishimete mite yo pyon pyoko
Samukute joutou samuiko wa tsuyoi
Korezo NICO NICO NIIIIIIIIIIIIIIIIIIIIIko no joshidou
Pyon pyoko pyon pyon Kaawaii
Kaminoke ga hanete pyon pyoko
Ookiku maware NICO NICO NIIIIIIIIIIIIIIIIIIIIIIko NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIko todoke
Pyon pyoko pyon pyon Kaawaii
Kaminoke ga hanete pyon pyoko
Itasa mo honki warui ka honki sa
Sore ga NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIIko no joshidou
Niko puri NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIIIko NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIIIIko NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIIIIIko puri YEAH NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIIIIIIko NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIIIIIIIko
Niko puri NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIko NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIko NICO NICO NIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIko puri YEAH PuritiGIRL
</pre>
EOT
        ,
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
