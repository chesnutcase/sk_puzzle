<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', function (Request $request) {
    if (password_verify($request->input('password'), App\Secret::where(['key' => 'sk_key'])->first()->value)) {
        $loginCookie = str_random(15);
        $request->session()->put('loggedInAs', 'SK');

        return response('');
    } else {
        return response('', 403);
    }
});

Route::prefix('game')->middleware('game')->group(function () {
    Route::get('/', function (Request $request) {
        return view('home');
    });
    Route::get('/puzzle/{id}', function (Request $request, $id) {
        $puzzle = \App\Puzzle::find($id);

        return view('puzzle', ['puzzle' => $puzzle]);
    });
    Route::prefix('api')->group(function () {
        Route::get('/puzzle/{id}', function (Request $request, $id) {
            $puzzle = \App\Puzzle::find($id);
            if ($puzzle == null) {
                return response('', 404);
            }
            $responseObj = new \stdClass();
            $responseObj->id = $id;
            $responseObj->shortDescription = \App\Puzzle::find($id)->shortDescription;
            $attempts = $puzzle->attempts()->orderBy('created_at', 'desc')->get();
            $solved = false;
            foreach ($attempts as $attempt) {
                if ($attempt->results->pluck('verdict')->unique()->search('OK') !== false) {
                    $solved = true;
                    break;
                }
            }
            $responseObj->solved = $solved;

            return json_encode($responseObj);
        });
        Route::post('/compile', function (Request $request) {
            $attempt = new \App\Attempt();
            $attempt->code = $request->input('code');
            $attempt->puzzle_id = $request->input('puzzle');
            try {
                $attempt->compile();
                $responseObj = new \stdClass();
                $responseObj->status = 'OK';
                $responseObj->id = $attempt->id;

                return json_encode($responseObj);
            } catch (\Exception $ex) {
                $responseObj = new \stdClass();
                $responseObj->status = 'Error';
                $responseObj->id = $attempt->id;
                $responseObj->error = $ex->getMessage();

                return json_encode($responseObj);
            }
        });
        Route::post('/test', function (Request $request) {
            $attempt = \App\Attempt::find($request->input('attempt'));
            $attempt->test();

            return json_encode($attempt->results);
        });
    });
});
