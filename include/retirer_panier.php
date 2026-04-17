<?php
session_start();

// On vérifie si un ID est bien envoyé dans l'URL
if (isset($_GET['id'])) {
    $id_a_supprimer = $_GET['id'];

    // On vérifie si le panier existe et n'est pas vide
    if (!empty($_SESSION['panier'])) {
        // On parcourt le panier pour trouver le produit
        foreach ($_SESSION['panier'] as $index => $produit) {
            if ($produit['id'] == $id_a_supprimer) {
                // On retire le produit du tableau
                unset($_SESSION['panier'][$index]);
            }
        }
        
        // IMPORTANT : On réorganise les clés du tableau pour éviter des erreurs
        $_SESSION['panier'] = array_values($_SESSION['panier']);
    }
}

// Une fois fini, on repart direct vers la page du panier
header("Location: panier.php");
exit();