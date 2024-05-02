<?php
function conectarDB() : PDO {
    $host = 'localhost';
    $dbname = 'loldatabase_crud';
    $user = 'root';
    $password = '';

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        // Establecer el modo de error a excepción
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}