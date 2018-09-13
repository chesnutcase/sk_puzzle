<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapPiece extends Model
{
    public function puzzle()
    {
        return $this->belongsTo('App\Puzzle');
    }
}
