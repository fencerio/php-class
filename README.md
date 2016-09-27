

# PHP Class
## For accessing the Fencer.io API

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

// Make calls to the API
$inside = $fencer->positionInside();
print_r($inside);
echo "<hr>";

$status = $fencer->positionStatus();
print_r($status);
echo "<hr>";

$in = $fencer->navigateIn();
print_r($in);
echo "<hr>";

$out = $fencer->navigateOut();
print_r($out);
echo "<hr>";

$origin = $fencer->navigateOrigin();
print_r($origin);
echo "<hr>";

$geofence = $fencer->getGeofences();
print_r($geofence);
echo "<hr>";
```

## License

GPL license