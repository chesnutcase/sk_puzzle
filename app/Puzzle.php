<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    public function testCases()
    {
        return $this->hasMany("App\TestCase");
    }

    public function attempts()
    {
        return $this->hasMany("App\Attempt");
    }
}
