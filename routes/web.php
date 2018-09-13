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
        $request->session()->put('loggedInAs', 'SK');

        return response('');
    } else {
        return response('', 403);
    }
});

Route::post('/adminLogin', function (Request $request) {
    if (password_verify($request->input('password'), App\Secret::where(['key' => 'admin_key'])->first()->value)) {
        $request->session()->put('loggedInAs', 'admin');

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
                $uniqueResults = $attempt->results->pluck('verdict')->unique();
                if ($uniqueResults->count() == 1 && $uniqueResults->first() == 'OK') {
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

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return view('adminHome');
    });
    Route::get('/puzzle/{id}', function (Request $request, $id) {
        $puzzle = \App\Puzzle::find($id);
        $mapPiece = \App\MapPiece::find($id);

        return view('puzzleEdit', ['puzzle' => $puzzle, 'mapPiece' => $mapPiece]);
    });
    Route::post('puzzle', function (Request $request) {
        $validatedData = $request->validate([
          'puzzleName' => 'required',
          'puzzleId' => 'required|numeric',
          'puzzleDescription' => 'required',
          'testCases' => 'required|JSON',
          'puzzleTimeLimit' => 'required|numeric',
      ]);
        nani();
        $puzzle = \App\Puzzle::find($request->input('puzzleId'));
        $mapPiece = \App\MapPiece::find($request->input('puzzleId'));
        $mapPiece->imagePath = $request->file('image')->store('maps');
        $puzzle->shortDescription = $request->input('puzzleName');
        $puzzle->description = $request->input('puzzleDescription');
        $puzzle->timeLimit = $request->input('puzzleTimeLimit');
        $backupTestCases = $puzzle->testCases()->get();
        $puzzle->attempts()->delete();
        $puzzle->testCases()->delete();
        $inputTestCases = json_decode($request->input('testCases'));
        try {
            foreach ($inputTestCases as $inputTestCase) {
                $puzzle->testCases()->create([
              'input' => $inputTestCase->input,
              'output' => $inputTestCase->output,
              ])->save();
            }
        } catch (\Exception $ex) {
            foreach ($backupTestCases as $backupTestCase) {
                $backupTestCase->save();
            }
        }
        $puzzle->save();
        $mapPiece->save();

        return redirect('/admin/puzzle/'.$puzzle->id)->with(['message' => 'saved']);
    });
});
