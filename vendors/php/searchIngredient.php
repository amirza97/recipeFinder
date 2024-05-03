<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

$executionStartTime = microtime(true);

// Prepare the API request URL
$query = isset($_REQUEST['searchIngredient']) ? $_REQUEST['searchIngredient'] : '';
$apiKey = '5aecc3e8022c41a58a5f88b040676702';
$url = "https://api.spoonacular.com/food/ingredients/search?apiKey={$apiKey}&query=" . urlencode($query) . "&number=20";

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);
curl_close($ch);

$decode = json_decode($result, true);

$output = [
    'status' => [
        'code' => "200",
        'name' => "ok",
        'description' => "success",
        'returnedIn' => intval((microtime(true) - $executionStartTime) * 1000) . " ms"
    ],
    'data' => []
];

// Check if the decoded JSON contains the expected data
if (isset($decode['results'])) {
    foreach ($decode['results'] as $ingredient) {
        // Check and assign a default image if 'image' key is missing or empty
        $imageUrl = isset($ingredient['image']) ? 'https://spoonacular.com/cdn/ingredients_100x100/' . $ingredient['image'] : 'path/to/default/image.jpg';
        $ingredient['image'] = $imageUrl;
        $output['data'][] = $ingredient;
    }
} else {
    $output['status']['description'] = "No data found";
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output);

?>
