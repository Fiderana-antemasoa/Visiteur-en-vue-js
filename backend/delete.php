<?php

header("Access-Control-Allow-Origin: *"); // Autorise toutes les origines
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Autorise les méthodes utilisées
header("Access-Control-Allow-Headers: Content-Type"); // Autorise l'en-tête Content-Type

include 'db.php';
$data = json_decode(file_get_contents("php://input"), true);

$sql = "DELETE FROM visiteur WHERE id = ?";
$stmt = $pdo->prepare($sql);
$success = $stmt->execute([$data['id']]);

echo json_encode([
    'success' => $success,
    'message' => $success ? "Suppression réussie" : "Suppression échouée"
]);
?>
