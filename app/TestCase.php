<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestCase extends Model
{
    public function puzzle()
    {
        return $this->belongsTo("App\Puzzle");
    }
}
