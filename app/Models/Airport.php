<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    public function flight()
    {
        return $this->hasMany(Flight::class);
    }
}
