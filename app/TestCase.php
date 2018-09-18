<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestCase extends Model
{
    protected $fillable = [
      'input',
      'output',
    ];

    public function puzzle()
    {
        return $this->belongsTo("App\Puzzle");
    }
}
