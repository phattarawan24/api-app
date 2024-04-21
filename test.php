<?php
// Replace 'YOUR_API_KEY' with your actual Google Maps API key
$apiKey = 'AIzaSyAuBgB7iBvSTjAvZ-LGhpYk67sN9Vq0i1U';

// Example address
$address = '1600 Amphitheatre Parkway, Mountain View, CA';

// Format the address for the URL
$formattedAddress = urlencode($address);

// Make a request to Google Maps Geocoding API
$apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=$formattedAddress&key=$apiKey";
$response = file_get_contents($apiUrl);
$data = json_decode($response);

// Check if the request was successful and has results
if ($data->status == 'OK' && !empty($data->results)) {
    $location = $data->results[0]->geometry->location;
    $latitude = $location->lat;
    $longitude = $location->lng;

    echo "Latitude: $latitude, Longitude: $longitude";
} else {
    echo "Error getting coordinates";
}
?>