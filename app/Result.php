<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
      'verdict',
    ];

    public function attempt()
    {
        return $this->belongsTo("App\Attempt");
    }

    public function testCase()
    {
        return $this->belongsTo("App\TestCase");
    }
}
