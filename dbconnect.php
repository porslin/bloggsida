<?php
// error management
// echo "<pre>";
// print_r(PDO::getAvailableDrivers());
// echo "</pre>";

// info to the database im connecting to 
$host       = "localhost";
$database   = "blog";
$user       = "root";
$pass       = "root";
$charset    = "utf8mb4";

// creating a dsn? 
$dsn        = "mysql:host={$host};dbname={$database};charset={$charset}";

// setting options 
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // error mode
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC    // fetch style: format of called data
];

//establishing database
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // echo $e->getMessage();
    // echo $e->getCode();
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);