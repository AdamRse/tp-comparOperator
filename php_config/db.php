<?php
try {
    $connexion = new PDO("mysql:host=5.39.77.77;dbname=tp-tour-operator", 'tp-tour-operator', 'GxBN4dQixeH(XjQ-', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (\Throwable $th) {
    die('erreur db');
}