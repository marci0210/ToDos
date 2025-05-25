<?php
$db_url = getenv("DATABASE_URL");

if (!$db_url) {
    die("Error: DATABASE_URL not found");
}

$db = parse_url($db_url);

$host = $db['host'];
$port = $db['port'];
$user = $db['user'];
$pass = $db['pass'];
$name = ltrim($db['path'], '/');

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$name", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error with connection: " . $e->getMessage());
}
?>