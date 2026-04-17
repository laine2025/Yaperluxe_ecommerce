<?php
session_start();
include 'include/db_connect.php';

// Je récupère le contenu JSON envoyé par le JavaScript
$json = file_get_contents('php://input');
$panier = json_decode($json, true);

if (!$panier || !isset($_SESSION['id_user'])) {
    echo json_encode(['success' => false, 'message' => 'Panier vide ou utilisateur non connecté']);
    exit;
}

try {
    $pdo->beginTransaction(); // On démarre une transaction pour la sécurité

    // J'effectue le calcul le total
    $total = 0;
    foreach ($panier as $item) { $total += $item['price']; }

    //  je créer la commande
    $sqlCom = "INSERT INTO commandes (id_user, total_com, statut) VALUES (?, ?, 'En attente')";
    $stmtCom = $pdo->prepare($sqlCom);
    $stmtCom->execute([$_SESSION['id_user'], $total]);
    
    $id_commande = $pdo->lastInsertId(); // Ici je récupère l'ID de la commande qu'on vient de créer

    // Je fais l'insertion les lignes de commande
    $sqlLigne = "INSERT INTO ligne_commande (id_com, id_prod, quantite, prix_unitaire) VALUES (?, ?, ?, ?)";
    $stmtLigne = $pdo->prepare($sqlLigne);

    foreach ($panier as $item) {
        // Note: Dans un vrai projet, on récupère l'id_prod depuis le JSON
        // Ici, on met 1 par défaut pour l'exemple, à adapter selon ton JSON
        $stmtLigne->execute([$id_commande, $item['id'] ?? 1, 1, $item['price']]);
    }

    $pdo->commit(); // On valide tout en base de données
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    $pdo->rollBack(); // En cas d'erreur, on annule tout
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}