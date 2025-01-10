<?php

namespace App\Controllers;

use App\Models\FlightModel;
use CodeIgniter\HTTP\ResponseInterface;

class FlightsController extends BaseController
{
    protected $flightModel;

    public function __construct()
    {
        $this->flightModel = new FlightModel();
    }

    public function search()
    {
        // Show the initial search form
        return view('recomm/flights_search');
    }

    public function scrape()
    {
        $origin = $this->request->getGet('origin');
        $destination = $this->request->getGet('destination');
        $departDate = $this->request->getGet('departDate');

        if (!$origin || !$destination || !$departDate) {
            return redirect()->to('/flights/search');
        }

        try {
            $flights = $this->flightModel->searchFlights($origin, $destination, $departDate);

            return view('recomm/flights_results', [
                'flights' => $flights,
                'origin' => $origin,
                'destination' => $destination,
                'departDate' => $departDate
            ]);

        } catch (\Exception $e) {
            log_message('error', 'FlightsController error: ' . $e->getMessage());
            
            return view('recomm/flights_results', [
                'error' => ENVIRONMENT === 'development' ? $e->getMessage() : 'Failed to fetch flight data',
                'origin' => $origin,
                'destination' => $destination,
                'departDate' => $departDate
            ]);
        }
    }
}