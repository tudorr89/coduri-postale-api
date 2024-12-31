<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function numbers()
    {
        return $this->hasMany(Number::class);
    }
}
