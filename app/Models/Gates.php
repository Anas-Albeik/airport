<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gates extends Model
{
    public function departureFlights()
    {
        return $this->hasMany(Flight::class, 'departure_gate_id');
    }
    public function arrivalFlights()
    {
        return $this->hasMany(Flight::class, 'arrival_gate_id');
}
}
