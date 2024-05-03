<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

header('Content-Type: application/json; charset=UTF-8');
$executionStartTime = microtime(true);

$ingredients = $_GET['foodIngredient'] ?? null;
$numberOfResults = $_GET['numberOfResults'] ?? 10;

if (!$ingredients) {
    echo json_encode(['status' => ['code' => 400, 'description' => "Missing required parameter: foodIngredient"]]);
    exit;
}

$apiKey = 'd0857bf7ff164fc69a0cb0d76b091363';
$url = "https://api.spoonacular.com/recipes/findByIngredients?apiKey=$apiKey&ingredients=" . urlencode($ingredients) . "&number=$numberOfResults";

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
if (json_last_error() !== JSON_ERROR_NONE || !is_array($decode)) {
    echo json_encode(['status' => ['code' => 500, 'description' => "Failed to decode JSON or not the expected array format"]]);
    exit;
}

echo json_encode([
    'status' => ['code' => 200, 'description' => "success"],
    'data' => array_map(function ($recipe) {
        $originals = [];
        foreach (($recipe['missedIngredients'] ?? []) as $ingredient) {
            $originals[] = $ingredient['original'];
        }
        foreach (($recipe['usedIngredients'] ?? []) as $ingredient) {
            $originals[] = $ingredient['original'];
        }
        return [
            'id' => $recipe['id'],
            'title' => $recipe['title'],
            'image' => $recipe['image'] ?? 'path/to/default/image.jpg',
            'original' => implode(", ", $originals)  // Combine all original descriptions into a single string
        ];
    }, $decode),
    'total' => count($decode)
]);
?>
