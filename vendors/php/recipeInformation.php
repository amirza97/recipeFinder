<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

header('Content-Type: application/json; charset=UTF-8');
$executionStartTime = microtime(true);

$id = $_GET['recipeID'] ?? null;
if (!$id) {
    echo json_encode(['status' => ['code' => 400, 'description' => "Missing recipe ID"]]);
    exit;
}

$apiKey = 'c9491edf8aca47df8094e32156afcb9e';
$url = "https://api.spoonacular.com/recipes/$id/analyzedInstructions?apiKey=$apiKey&stepBreakdown=true";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo json_encode(['status' => ['code' => 500, 'description' => curl_error($ch)]]);
    curl_close($ch);
    exit;
}
curl_close($ch);

$decode = json_decode($result, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['status' => ['code' => 500, 'description' => 'Failed to decode JSON']]);
    exit;
}

$steps = $decode[0]['steps'] ?? [];
echo json_encode([
    'status' => ['code' => 200, 'description' => "success"],
    'data' => array_map(function ($step) {
        return ['id' => $step['number'], 'description' => $step['step']];
    }, $steps)
]);
