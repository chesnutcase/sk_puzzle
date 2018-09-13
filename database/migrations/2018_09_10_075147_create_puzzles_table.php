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
          'description' => <<<'EOT'
Given any input, print <code>Hello World!</code>.
<h3>Input</h3>
<em>Nothing</em>
<h3>Output</h3>
<pre>Hello World!</pre>
EOT
          ,
          'timeLimit' => 1,
        ]);

        DB::table('puzzles')->insert([
          'id' => 2,
          'shortDescription' => 'Multiply by two',
          'description' => <<<'EOT'
Given any input, multiply the input by two and write to standard output.
<h3>Input</h3>
Integer <code>x</code> where 0 ≤ <code>x</code> ≤ 2<sup>32</sup> - 1.
<h3>Output</h3>
The input multiplied by 2.
<h3>Examples</h3>
<h4>Input 1</h4>
<pre>0</pre>
<h4>Output 1</h4>
<pre>0</pre>
<h4>Input 2</h4>
<pre>1</pre>
<h4>Output 2</h4>
<pre>2</pre>
EOT
          ,
          'timeLimit' => 1,
        ]);

        DB::table('puzzles')->insert([
          'id' => 3,
          'shortDescription' => 'Find Prime Numbers',
          'description' => <<<'EOT'
Given any input, determine if the number is prime. Output, to standard output, <code>0</code> if it is non-prime and <code>1</code> if it is prime.
<h3>Input</h3>
An nunmber <code>x</code> between 0 and 10000.
<h3>Output</h3>
<code>0</code> if <code>x</code> is non-prime and <code>1</code> if <code>x</code> is prime.
<h3>Example</h3>
<h4>Input 1</h4>
<pre>1</pre>
<h4>Output 1</h4>
<pre>0</pre>
<h4>Input 2</h4>
<pre>4643</pre>
<h4>Output 2</h4>
<pre>1</pre>
EOT
          ,
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
          'description' => <<<'EOT'
<span class="text-muted">This was taken from Redmart's blog <a href="http://geeks.redmart.com/2015/01/07/skiing-in-singapore-a-coding-diversion/">here.</a></span>
<p>Sometimes it's nice to take a break and code up a solution to a small, fun problem. Here is one some of our engineers enjoyed recently. It's called Skiing In Singapore.</p>
<p>Well you can’t really ski in Singapore. But let’s say you hopped on a flight to the Niseko ski resort in Japan. Being a software engineer you can’t help but value efficiency, so naturally you want to ski as long as possible and as fast as possible without having to ride back up on the ski lift. So you take a look at the map of the mountain and try to find the longest ski run down.</p>
<p>In digital form the map looks like the number grid below.</p>
<pre>
4 4
4 8 7 3
2 5 9 3
6 3 2 5
4 4 1 6
</pre>
<p>The first line <code>4 4</code> indicates that this is a 4x4 map. Each number represents the elevation of that area of the mountain. From each area (i.e. box) in the grid you can go north, south, east, west - but only if the elevation of the area you are going into is less than the one you are in. I.e. you can only ski downhill. You can start anywhere on the map and you are looking for a starting point with the longest possible path down as measured by the number of boxes you visit. And if there are several paths down of the same length, you want to take the one with the steepest vertical drop, i.e. the largest difference between your starting elevation and your ending elevation.</p>
<p>On this particular map the longest path down is of length=5 and it’s highlighted in red below: <code>9-5-3-2-1</code>.</p>
<pre>
4 4
4 8 7 3
2 <b style="color:red">5</b> <b style="color:red">9</b> 3
6 <b style="color:red">3</b> <b style="color:red">2</b> 5
4 4 <b style="color:red">1</b> 6
</pre>
<p>There is another path that is also length five: <code>8-5-3-2-1</code>..
<p>Given a digital map like the ones shown here, output the length of the longest path.</p>
<h3>Input</h3>
The first line contains two integers, <code>x</code> and <code>y</code>, that represents the dimensions of the map.
The next <code>y</code> lines with <code>x</code> columns contain numbers <code>n<sub>i</sub></code> that represents the elevation of that point on the map.
<h3>Output</h3>
An integer representing the length of the longest path.
<h3>Examples</h3>
<h4>Input 1</h4>
<pre>
4 4
4 8 7 3
2 5 9 3
6 3 2 5
4 4 1 6
</pre>
<h4>Output 1</h4>
<pre>5</pre>
<h4>Input 2</h4>
<pre>
10 10
18 5 22 81 55 85 84 100 24 56
57 73 14 34 95 5 48 21 72 4
73 90 20 93 79 77 18 7 62 93
71 9 10 42 24 81 80 84 34 66
87 8 92 25 94 37 23 83 5 34
68 85 65 99 45 25 44 23 61 97
53 13 3 20 37 29 84 88 34 10
82 6 7 71 69 99 48 18 83 11
19 35 66 16 53 4 66 5 74 15
35 88 99 43 63 65 69 2 63 58
</pre>
<h4>Output 2</h4>
<pre>7</pre>
EOT
          ,
          'timeLimit' => '5',
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
