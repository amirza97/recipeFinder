<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    $executionStartTime = microtime(true);

    // Assuming you're getting some nutrition input from a request, like minimum protein
    $minProtein = $_REQUEST['minProtein'] ?? 0; // Default to 0 if not provided

    $apiKey = '5aecc3e8022c41a58a5f88b040676702';
    $url = "https://api.spoonacular.com/recipes/findByNutrients?apiKey={$apiKey}&minProtein={$minProtein}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $result = curl_exec($ch);
    curl_close($ch);

    $decode = json_decode($result, true);

    $output['status']['code'] = "200";
    $output['status']['name'] = "ok";
    $output['status']['description'] = "success";
    $output['status']['returnedIn'] = intval((microtime(true) - $executionStartTime) * 1000) . " ms";

    // Process each recipe to include only the necessary nutrition details
    $output['data'] = array_map(function($recipe) {
        return [
            'id' => $recipe['id'],
            'title' => $recipe['title'],
            'image' => $recipe['image'],
            'calories' => $recipe['calories'] ?? 'N/A',
            'carbs' => $recipe['carbs'] ?? 'N/A',
            'fat' => $recipe['fat'] ?? 'N/A',
            'protein' => $recipe['protein'] ?? 'N/A'
        ];
    }, $decode);

    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($output);
?>
