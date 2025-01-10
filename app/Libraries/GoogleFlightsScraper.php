<?php

namespace App\Libraries;

use CodeIgniter\HTTP\CURLRequest;

class GoogleFlightsScraper
{
    private $client;
    private $headers;

    public function __construct()
    {
        $this->client = \Config\Services::curlrequest();
        $this->headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Accept-Language' => 'en-US,en;q=0.5',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive',
            'Upgrade-Insecure-Requests' => '1',
            'Sec-Fetch-Dest' => 'document',
            'Sec-Fetch-Mode' => 'navigate',
            'Sec-Fetch-Site' => 'none',
            'Sec-Fetch-User' => '?1'
        ];
    }

    public function scrapeFlights($origin, $destination, $departDate)
    {
        try {
            // First request to get necessary cookies and tokens
            $initialResponse = $this->client->request('GET', 'https://www.google.com/travel/flights', [
                'headers' => $this->headers,
                'http_errors' => false
            ]);

            if ($initialResponse->getStatusCode() != 200) {
                throw new \Exception("Initial page load failed");
            }

            // Build the search URL with proper parameters
            $formattedDate = date('Y-m-d', strtotime($departDate));
            $searchUrl = $this->buildSearchUrl($origin, $destination, $formattedDate);

            // Make the search request
            $response = $this->client->request('GET', $searchUrl, [
                'headers' => array_merge($this->headers, [
                    'Referer' => 'https://www.google.com/travel/flights',
                ]),
                'http_errors' => false,
                'cookies' => $initialResponse->getCookie()
            ]);

            if ($response->getStatusCode() != 200) {
                throw new \Exception("Search request failed");
            }

            $html = $response->getBody();
            return $this->extractFlights($html);

        } catch (\Exception $e) {
            log_message('error', 'GoogleFlightsScraper error: ' . $e->getMessage());
            throw $e;
        }
    }

    private function buildSearchUrl($origin, $destination, $departDate)
    {
        $params = http_build_query([
            'hl' => 'en',
            'gl' => 'US',
            'curr' => 'USD',
            'tfs' => '1', // one-way flight
            'source' => 'search',
            'q' => sprintf('Flights from %s to %s on %s', $origin, $destination, $departDate),
            'rf' => sprintf('%s,%s,%s,1,0,0', $origin, $destination, $departDate)
        ]);

        return "https://www.google.com/travel/flights/search?" . $params;
    }

    private function extractFlights($html)
    {
        $flights = [];
        $dom = new \DOMDocument();
        @$dom->loadHTML($html, LIBXML_NOERROR);
        $xpath = new \DOMXPath($dom);

        // Updated selectors based on the JS reference
        $flightCards = $xpath->query("//div[contains(@class, 'yR1fYc')]");

        foreach ($flightCards as $card) {
            // Airline info
            $airline = $this->extractContent($xpath, ".//span[contains(@class, 'sSHqwe tPgKwe ogfYpf')]//span", $card);
            
            // Times
            $departureTime = $this->extractContent($xpath, ".//span[@jscontroller='cNtv4b' and contains(@aria-label, 'Departure time')]//span[@role='text']", $card);
            $arrivalTime = $this->extractContent($xpath, ".//span[@jscontroller='cNtv4b' and contains(@aria-label, 'Arrival time')]//span[@role='text']", $card);
            
            // Airports
            $airports = $xpath->query(".//span[@jscontroller='cNtv4b' and not(@role='text')]", $card);
            $departureAirport = $airports->length > 0 ? trim($airports->item(0)->textContent) : '';
            $arrivalAirport = $airports->length > 1 ? trim($airports->item(1)->textContent) : '';
            
            // Price
            $price = $this->extractContent($xpath, ".//span[@data-gs]", $card);

            // Duration and stops
            $duration = $this->extractContent($xpath, ".//div[contains(@class, 'gvkrdb')]//span[@role='text']", $card);
            $stops = $this->extractContent($xpath, ".//div[contains(@class, 'BbR8Ec')]", $card);

            if ($airline && $departureTime && $arrivalTime) {
                $flights[] = [
                    'airline' => trim($airline),
                    'departureTime' => trim($departureTime),
                    'arrivalTime' => trim($arrivalTime),
                    'departureAirport' => trim($departureAirport),
                    'arrivalAirport' => trim($arrivalAirport),
                    'price' => trim($price),
                    'duration' => trim($duration),
                    'stops' => trim($stops)
                ];

                if (count($flights) >= 20) {
                    break;
                }
            }
        }

        return $flights;
    }

    private function extractContent($xpath, $query, $context)
    {
        $nodes = $xpath->query($query, $context);
        return $nodes->length > 0 ? $nodes->item(0)->textContent : '';
    }
}