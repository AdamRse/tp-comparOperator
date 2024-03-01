<?php
try {
    $connexion = new PDO("mysql:host=5.39.77.77;dbname=tp-tour-operator", 'tp-tour-operator', '!YUYw]9JHJ6AQ1mG', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (\Throwable $th){
    die('erreur db');
}