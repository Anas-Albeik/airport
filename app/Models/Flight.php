<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function airplane()
    {
        return $this->hasOne(Airplane::class);
    }
 public function departureGate()
    {
        return $this->belongsTo(Gates::class, 'departure_gate');
    }
    public function arrivalGate()
    {
        return $this->belongsTo(Gates::class, 'arrival_gate');
    }
    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
