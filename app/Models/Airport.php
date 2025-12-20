<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Airport extends Model
{
    use HasFactory;

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function City()
    {
        return $this->belongsTo(City::class);
    }
  
}
