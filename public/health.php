<?php

$engine = getenv("DB_CONNECTION");
$host = getenv(strtoupper(getenv("DB_SERVICE_NAME"))."_SERVICE_HOST");
$port = getenv(strtoupper(getenv("DB_SERVICE_NAME"))."_SERVICE_PORT");
$database = getenv("DB_DATABASE");
$username = getenv("DB_USERNAME");
$password = getenv("DB_PASSWORD");

try {
    // Test database connection
	if ($engine == "mysql") {
		$dsn = "mysql:dbname={$database};host={$host};port={$port}";
		$conn = new PDO($dsn, $username, $password);
	} elseif ($engine == "pgsql") {
		$dsn = "pgsql:dbname={$database};host={$host};port={$port}";
		$conn = new PDO($dsn, $username, $password);
	} else {
		$dsn = 'sqlite:'.getenv("HOME").'/database/database.sqlite';
		$conn = new PDO($dsn);
	}
} catch (PDOException $e) {
	header("HTTP/1.1 503 Service Unavailable");
    die("Connection failed: " . $e->getMessage());
}

echo "OK";
?>