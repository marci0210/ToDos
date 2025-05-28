<?php
$db_url = getenv("DATABASE_URL");

if (!$db_url) {
    die("Error: DATABASE_URL not found");
}

$db_parsed_url = parse_url($db_url);

$host = $db_parsed_url['host'];
$port = $db_parsed_url['port'];
$user = $db_parsed_url['user'];
$pass = $db_parsed_url['pass'];
$dbname = ltrim($db_parsed_url['path'], '/');

$conn_string = sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s",
    $host,
    $port,
    $dbname,
    $user,
    $pass
);

$db = pg_connect($conn_string);

if (!$db) {
    die("Error: Could not connect to database");
}

return $db;
?>