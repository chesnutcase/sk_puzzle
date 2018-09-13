<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Process\Process;

class Attempt extends Model
{
    public function puzzle()
    {
        return $this->belongsTo("App\Puzzle");
    }

    public function results()
    {
        return $this->hasMany("App\Result");
    }

    public function compile()
    {
        $sourcePath = '/tmp/puzzle_'.time().'.cpp';
        file_put_contents($sourcePath, $this->code);
        $compileProc = new Process('g++ '.$sourcePath.' -o '.str_replace('.cpp', '.out', $sourcePath));
        $exitCode = $compileProc->run();
        if ($exitCode == 0) {
            $this->outfile = str_replace('.cpp', '.out', $sourcePath);
            $this->save();

            return $this->getOutput;
        } else {
            $this->save();
            $this->results()->create([
              'verdict' => 'Compilation Error - '.$compileProc->getErrorOutput(),
            ])->save();
            throw new \Exception($compileProc->getErrorOutput());
        }
    }

    public function test()
    {
        foreach ($this->puzzle->testCases as $testCase) {
            /*
              $testProc = new Process([
                'echo',
                "'".$testCase->input."'",
                '|',
                'timeout',
                $this->puzzle->timeLimit,
                $this->outfile, ]);*/
            $testProc = new Process(
              $this->outfile, null, null, $testCase->input, $this->puzzle->timeLimit, null
            );
            $result = new \App\Result();
            $result->attempt_id = $this->id;
            $result->test_case_id = $testCase->id;
            try {
                $exitCode = $testProc->run();
                if ($exitCode == 0) {
                    if ($testCase->output == $testProc->getOutput()) {
                        $result->verdict = 'OK';
                    //$result->description = $testProc->getOutput();
                    } else {
                        $result->verdict = 'Incorrect output';
                        //$result->description = $testProc->getOutput();
                    }
                } else {
                    $result->verdict = $testProc->getErrorOutput();
                    if (trim($testProc->getErrorOutput()) == '') {
                        $result->verdict = 'Program exited with non-zero exit code: '.$exitCode;
                    }
                }
            } catch (\Exception $ex) {
                $result->verdict = $ex->getMessage();
            }
            $result->save();
        }
    }
}
