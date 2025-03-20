<?php
// Database connection details
$host = 'localhost';
$dbname = 'bronx luggage'; // replace with your database name
$user = 'root';
$pass = 'root'; // replace with your MAMP MySQL password

// Create a connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
