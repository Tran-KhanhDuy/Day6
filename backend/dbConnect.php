<?php

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'test';

function connectDb() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS , DB_NAME);

    if ($conn->connect_error) {
        die("Connect to DB Error: " . $conn->connect_error);
    }

    $conn->query("SET NAMES 'utf8mb4'"); 
    $conn->query("SET CHARACTER SET UTF8MB4");  
    $conn->query("SET SESSION collation_connection = 'utf8mb4_unicode_ci'");

    return $conn;
}