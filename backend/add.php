<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Gérer les requêtes préliminaires (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

// Validation des données
if (empty($data['nom']) || !preg_match('/^[a-zA-ZÀ-ÿ\s]{2,}$/', trim($data['nom']))) {
    http_response_code(400);
    die(json_encode([
        'success' => false, 
        'message' => 'Le nom doit contenir uniquement des lettres (2 caractères minimum)'
    ]));
}

if (!isset($data['nb_jours']) || !is_numeric($data['nb_jours']) || $data['nb_jours'] <= 0) {
    http_response_code(400);
    die(json_encode([
        'success' => false, 
        'message' => 'Nombre de jours invalide (doit être un nombre positif)'
    ]));
}

if (!isset($data['tarif_journalier']) || !is_numeric($data['tarif_journalier']) || $data['tarif_journalier'] < 0) {
    http_response_code(400);
    die(json_encode([
        'success' => false, 
        'message' => 'Tarif journalier invalide (doit être un nombre positif ou zéro)'
    ]));
}

try {
    // Nettoyage supplémentaire du nom
    $nom = trim($data['nom']);
    $nom = preg_replace('/\s+/', ' ', $nom); // Supprime les espaces multiples

    $sql = "INSERT INTO visiteur (nom, nb_jours, tarif_journalier) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    $success = $stmt->execute([
        $nom,
        intval($data['nb_jours']),
        floatval($data['tarif_journalier'])
    ]);

    if ($success) {
        $lastId = $pdo->lastInsertId();
        echo json_encode([
            'success' => true,
            'message' => 'Insertion réussie',
            'data' => [
                'id' => $lastId,
                'nom' => $nom,
                'nb_jours' => intval($data['nb_jours']),
                'tarif_journalier' => floatval($data['tarif_journalier'])
            ]
        ]);
    } else {
        throw new PDOException("Erreur lors de l'insertion");
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur de base de données',
        'error' => $e->getMessage()
    ]);
}
?>