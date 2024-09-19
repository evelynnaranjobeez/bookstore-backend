<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

class WorldBankController extends Controller
{
    public function fetchLifeExpectancyData()
    {
        // Create a Guzzle HTTP client
        $client = new Client();

        // Send a GET request to the World Bank API
        $response = $client->get('https://api.worldbank.org/v2/country/ECU/indicator/SP.DYN.LE00.IN?format=json&per_page=500');

        // Decode the JSON response
        $data = json_decode($response->getBody(), true);

        // Return the fetched data as a response
        return response()->json([
            'success' => true,
            'data' => $data[1], // The actual data is in the second element of the array
        ]);
    }
}
