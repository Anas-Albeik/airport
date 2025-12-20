<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gates extends Model
{
    use HasFactory;

    public function departureFlights()
    {
        return $this->hasMany(Flight::class, 'departure_gate_id');
    }
    public function arrivalFlights()
    {
        return $this->hasMany(Flight::class, 'arrival_gate_id');
}
}
