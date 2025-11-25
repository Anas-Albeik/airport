<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Airport;
use App\Models\Airplane;
class Company extends Model
{
    public function airports()
    {
        return $this->belongsToMany(Airport::class);
    }
    public function airplanes()
    {
        return $this->hasMany(Airplane::class);
    }
    public function loyalty()
    {
        return $this->hasOne(Loyalty::class);
    }
}
