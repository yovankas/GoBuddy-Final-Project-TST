<?php

namespace App\Models;

use CodeIgniter\Model;

class FlightModel extends Model
{
    protected $table = 'flights';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'airline',
        'departur_time',
        'arrival_time',
        'departure_airport',
        'arrival_airport',
        'price',
        'duration',
        'flight_date'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function searchFlights($origin, $destination, $departDate)
    {
        $flights = $this->where([
            'departure_airport' => $origin,
            'arrival_airport' => $destination,
            'flight_date' => $departDate
        ])
        ->orderBy('price', 'ASC')
        ->limit(20)
        ->find();
        
        // Format duration for display
        foreach ($flights as &$flight) {
            $flight['duration'] = date('H\h i\m', strtotime($flight['duration']));
        }
        
        return $flights;
    }
}