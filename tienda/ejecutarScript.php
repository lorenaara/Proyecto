<?php

include "./seguro/conexion.php";
try {
    $conn = new PDO("mysql:host=" . HOST, USER, PASS);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $commands = file_get_contents("./tienda.sql");
    $conn->exec($commands);
    
} catch (PDOException $e) {
    print_r($e);
} finally {
    unset($conn); 
}