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
        return $this->belongsTo(Gates::class);
    }
    public function arrivalGate()
    {
        return $this->belongsTo(Gates::class);
    }
    public function departureAirport()
    {
        return $this->belongsTo(Airport::class);
    }
    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
