<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gates extends Model
{
    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }
    public function flight()
    {
        return $this->hasMany(Flight::class);

    }
    public function departureFlights()
    {
        return $this->self(Flight::class, 'departure_gate_id');
    }
    public function arrivalFlights()
    {
        return $this->self(Flight::class, 'arrival_gate_id');
}

]
