<?php
$host = 'localhost';
$db = 'visiteur_db'; 
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur de connexion']);
    exit;
}
?>
