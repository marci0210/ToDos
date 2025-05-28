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
$dbname = ltrim($db['path'], '/');

$conn_string = sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s",
    $host,
    $port,
    $dbname,
    $user,
    $pass
);

$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    die("Error: Could not connect to database");
}

return $dbconn;
?>