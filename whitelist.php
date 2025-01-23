<?php
// Define your whitelisted Place IDs
$whitelistedPlaceIds = array(106361627270674, 987654321, 555555555); // Replace these with your actual place IDs

// Get the place_id from the query parameter
if (isset($_GET['place_id'])) {
    $placeId = (int)$_GET['place_id']; // Cast to an integer to sanitize input

    // Check if the place ID is in the whitelist
    if (in_array($placeId, $whitelistedPlaceIds)) {
        // If the place ID is allowed, return "allowed"
        echo "allowed";
    } else {
        // If the place ID is not in the whitelist, return "not_allowed"
        echo "not_allowed";
    }
} else {
    // If the place_id parameter is not set, return an error
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    echo "Error: place_id parameter missing";
}
?>
