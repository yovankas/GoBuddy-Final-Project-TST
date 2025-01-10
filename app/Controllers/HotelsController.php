<?php

namespace App\Controllers;

use App\Models\HotelModel;
use CodeIgniter\HTTP\ResponseInterface;

class HotelsController extends BaseController
{
    protected $hotelModel;

    public function __construct()
    {
        $this->hotelModel = new HotelModel();
    }

    public function scrape()
    {
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 10;

        // Add input validation
        $destination = $this->request->getGet('destination');
        $checkin = $this->request->getGet('checkin');
        $checkout = $this->request->getGet('checkout');

        // Validate required parameters
        if (!$destination || !$checkin || !$checkout) {
            return redirect()->to('/hotels/search');
        }

        // Validate date formats
        if (!strtotime($checkin) || !strtotime($checkout)) {
            return redirect()->to('/hotels/search');
        }

        try {
            // Get hotels from database
            $hotels = $this->hotelModel->getHotelsWithDetails($destination, $page, $perPage);

            // Process the hotels data
            $processedHotels = [];
            foreach ($hotels as $hotel) {
                $processedHotels[] = [
                    'name' => $hotel['name'],
                    'rating' => (float)$hotel['rating'],
                    'reviewCount' => $hotel['review_count'],
                    'address' => $hotel['address'],
                    'price' => $hotel['price'],
                    'amenities' => array_slice($hotel['amenities'], 0, 5),
                    'thumbnail_url' => $hotel['thumbnail_url'],
                    'link' => $hotel['link']
                ];
            }

            // Debugging response if requested
            if ($this->request->getGet('debug') === 'true') {
                return $this->response->setJSON($processedHotels);
            }

            return view('recomm/hotels_results', [
                'hotels' => $processedHotels,
                'destination' => $destination,
                'checkin' => $checkin,
                'checkout' => $checkout
            ], ['debug' => false]);

        } catch (\Exception $e) {
            log_message('error', 'HotelsController error: ' . $e->getMessage());
            return view('recomm/hotels_results', [
                'error' => ENVIRONMENT === 'development' ? $e->getMessage() : 'Failed to fetch hotel data',
                'destination' => $destination,
                'checkin' => $checkin,
                'checkout' => $checkout
            ], ['debug' => false]);
        }
    }

    public function search()
    {
        return view('recomm/hotels_search');
    }
}