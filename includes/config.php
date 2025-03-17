<?php

// Database credentials
$db_host = 'localhost';          
$db_name = 'uottawa_nightlife_new';  
$db_user = 'root';               
$db_pass = '';                   

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);

    // Set error mode to Exception so we can catch errors easily
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // If the connection fails, show the error message and stop the script
    echo "Connection failed: " . $e->getMessage();
    exit;
}
