

# PHP Class
## PHP class containing methods which wrap the Fencer.io API

Consult the class and/or the API docs to establish which arguments are required. https://fencer.io/developers

Typical set up would be something like this. 

```
// Our keys and coordinates
$apiKey = "f7c04eaf-5510-5878-xxxxx-acad3c60f";
$accessKey = "4c89693a-02c4-xxxx-xxxx-cdf801237e3d";
$lat = 53.6750352651078;
$lng = -2.4879334942895883;

// Create the instance
$fencer = new fencerAPI($apiKey, $accessKey);

// Set coordinates
$fencer->setLat($lat);
$fencer->setLng($lng);

// Example call to the API
// Determine if passed lat/lng is inside geofence with
// $accessKey of 4c89693a-02c4-xxxx-xxxx-cdf801237e3d

$inside = $fencer->positionInside();

// Returns an object. Here we just print it
print_r($inside);
echo "<hr>";

```

## License

GPL license