<?php

header("Access-Control-Allow-Origin: *"); // Autorise toutes les origines
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Autorise les méthodes utilisées
header("Access-Control-Allow-Headers: Content-Type"); // Autorise l'en-tête Content-Type
include 'db.php';

$sql = "SELECT *, nb_jours * tarif_journalier AS tarif FROM visiteur";
$stmt = $pdo->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
if (!$pdo) {
  http_response_code(500);
  echo json_encode(["error" => "Erreur de connexion à la base"]);
  exit;
}

?>
