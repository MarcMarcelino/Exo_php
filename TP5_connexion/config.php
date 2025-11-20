<?php

try {
    // Configuration settings
    $mysqlClient = new PDO('mysql:host=localhost;dbname=Jo;charset=utf8', 'root', '');
}catch (PDOException $e) {
    // Handle connection error
    die('Database connection failed: ' . $e->getMessage());
}

