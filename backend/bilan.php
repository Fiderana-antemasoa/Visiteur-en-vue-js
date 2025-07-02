<?php

header("Access-Control-Allow-Origin: *"); // Autorise toutes les origines
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Autorise les méthodes utilisées
header("Access-Control-Allow-Headers: Content-Type"); // Autorise l'en-tête Content-Type

include 'db.php';

$sql = "SELECT 
    SUM(nb_jours * tarif_journalier) AS total,
    MIN(nb_jours * tarif_journalier) AS min,
    MAX(nb_jours * tarif_journalier) AS max
FROM visiteur";

$stmt = $pdo->query($sql);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($data);
?>
