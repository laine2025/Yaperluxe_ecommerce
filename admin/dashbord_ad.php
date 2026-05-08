<?php
session_start();


require_once '../include/db_connect.php'; 


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../connexion.php");
    exit();
}
include '../include/header_admin.php';
?>

<div class="container" style="max-width: 900px; margin: 0 auto;">
    <h1 style="text-align: center; margin-top: 30px;">Tableau de Bord</h1>

    <section>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>📦Catalogue</h2>
            <a href="ajouter_produit.php" class="btn-add">+ Nouveau Bijou</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Aperçu</th>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
               <?php
    $stmt = $pdo->query("SELECT * FROM produits ORDER BY 1 DESC");
    
    // J'ai utiliser FETCH_ASSOC pour appeler les colonnes par leur nom
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            
            <td><img src="../uploads/<?= $row['image_prod'] ?>" width="50" style="border-radius:8px;"></td>
            <td style="font-weight: bold;"><?= $row['nom_prod'] ?></td>
            <td style="color: var(--accent-gold);">
                <?php 
                    // On s'assure que c'est un nombre avant de formater
                    $prix = is_numeric($row['prix']) ? $row['prix'] : 0;
                    echo number_format($prix, 0, '.', ' ') . " FCFA"; 
                ?>
            </td>
            <td style="text-align: right;">
                <a href="update.php?id=<?= $row['id_prod'] ?>" style="color: var(--accent-white); text-decoration: none;">Modifier</a>
                <a href="delete.php?id=<?= $row['id_prod'] ?>" style="color: #ff4d4d; text-decoration: none; margin-left: 10px;">Supprimer</a>
            </td>
        </tr>
    <?php } ?>
            </tbody>
        </table>
    </section>

    <section style="margin-top: 40px;">
        <h2> Dernières Commandes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php
               
                try {
                    $orders = $pdo->query("SELECT c.id_commande, u.pseudo, c.total_ttc, c.statut 
                                         FROM commandes c 
                                         JOIN utilisateurs u ON c.id_user = u.id_user 
                                         ORDER BY c.id_commande DESC LIMIT 5");
                    while ($o = $orders->fetch()) { ?>
                        <tr>
                            <td>#<?= $o['id_commande'] ?></td>
                            <td><?= $o['pseudo'] ?></td>
                            <td><?= number_format($o['total_ttc'], 0, '.', ' ') ?> FCFA</td>
                            <td><span class="status-badge"><?= $o['statut'] ?></span></td>
                        </tr>
                <?php } 
                } catch(Exception $e) { echo "<tr><td colspan='4'>Aucune commande trouvée.</td></tr>"; } ?>
            </tbody>
        </table>
    </section>
</div>