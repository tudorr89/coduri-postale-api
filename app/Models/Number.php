<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    protected $guarded = [];

    public function zipcode()
    {
        return $this->belongsTo(Zipcode::class);
    }
}
