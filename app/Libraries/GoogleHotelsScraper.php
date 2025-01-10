<?php

namespace App\Libraries;

class GoogleHotelsScraper {
    public function __construct() {
        set_time_limit(300);
        ini_set('max_execution_time', '300');
    }

    public function scrapeHotels($destination, $checkin, $checkout) {
        try {
            $scriptPath = ROOTPATH . 'app/ThirdParty/puppeteer/scrapeGoogleHotels.js';
            
            if (!file_exists($scriptPath)) {
                throw new \Exception("Scraper script not found at: " . $scriptPath);
            }

            // Construct command
            $command = sprintf(
                'node "%s" "%s" "%s" "%s"',
                $scriptPath,
                escapeshellarg($destination),
                escapeshellarg($checkin),
                escapeshellarg($checkout)
            );

            // Log the command for debugging
            log_message('debug', 'Executing command: ' . $command);

            // Execute command and capture both stdout and stderr
            $output = [];
            $returnVar = 0;
            exec($command . ' 2>&1', $output, $returnVar);

            // Join all output lines
            $fullOutput = implode("\n", $output);

            // Log the full output for debugging
            log_message('debug', 'Raw output: ' . $fullOutput);

            // Find the JSON data in the output
            if (preg_match('/Final Results:\s*(\[.*\])/s', $fullOutput, $matches)) {
                $jsonString = $matches[1];
            } else if (preg_match('/(\[.*\])/s', $fullOutput, $matches)) {
                $jsonString = $matches[1];
            } else {
                throw new \Exception("No JSON data found in the output");
            }

            // Try to decode the JSON
            $data = json_decode($jsonString, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                // Log the problematic JSON string
                log_message('error', 'JSON decode error: ' . json_last_error_msg());
                log_message('error', 'JSON string: ' . $jsonString);
                throw new \Exception("Failed to parse JSON response: " . json_last_error_msg());
            }

            if ($returnVar !== 0) {
                throw new \Exception("Script execution failed with code: " . $returnVar);
            }

            return $data;

        } catch (\Exception $e) {
            log_message('error', 'GoogleHotelsScraper error: ' . $e->getMessage());
            throw $e;
        }
    }
}