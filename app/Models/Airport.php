<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
<<<<<<< HEAD
    //
=======
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
>>>>>>> 783d898d0f360abf1ed53fd6985f350877a9cfd0
}
