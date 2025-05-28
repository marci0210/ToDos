<?php
$accessKey = getenv('UNSPLASH_ACCESSKEY');

if (!$accessKey) {
    http_response_code(500);
    echo json_encode(['error' => 'Missing access key']);
    exit;
}

$orientation = isset($_GET['orientation']) && $_GET['orientation'] === 'portrait' ? 'portrait' : 'landscape';
$query = 'nature';

$url = "https://api.unsplash.com/photos/random?client_id={$accessKey}&query={$query}&orientation={$orientation}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Unsplash Proxy');
$response = curl_exec($ch);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

header('Content-Type: application/json');
echo $response;