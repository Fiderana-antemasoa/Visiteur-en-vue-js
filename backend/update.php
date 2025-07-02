<?php

header("Access-Control-Allow-Origin: *"); // Autorise toutes les origines
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Autorise les méthodes utilisées
header("Access-Control-Allow-Headers: Content-Type"); // Autorise l'en-tête Content-Type

include 'db.php';
$data = json_decode(file_get_contents("php://input"), true);

$sql = "UPDATE visiteur SET nom = ?, nb_jours = ?, tarif_journalier = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$success = $stmt->execute([
    $data['nom'], $data['nb_jours'], $data['tarif_journalier'], $data['id']
]);

echo json_encode([
    'success' => $success,
    'message' => $success ? "Modification réussie" : "Modification échouée"
]);
?>