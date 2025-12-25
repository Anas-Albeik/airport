<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

         return [
        'flight_number'    => 'required|string|max:10|unique:flights,flight_number',
        'city_id'          => 'required|integer|exists:cities,id',
        'arrival_airport'  => 'required|string|max:100',
        'departure_time'   => 'date',
        'arrival_time'     => 'date|after:departure_date',
        'departure_date'   => 'date',
        'arrival_date'     => 'date|after:departure_date',
        'status'           => 'required|in:scheduled,delayed,cancelled,departed,arrived',
        'gate_id'          => 'required|integer|exists:gates,id',
    ];
    }


}
