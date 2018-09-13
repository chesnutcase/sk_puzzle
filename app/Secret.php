<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    protected $fillable = [
    'key',
    'value',
  ];

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = bcrypt($value);
    }
}
