<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - YAPERLUXE</title>
    <style>

    :root {
        /* Palette de couleurs "Digne de ce nom" */
        --grad-dark: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        --gold-glow: 0 0 15px rgba(212, 175, 55, 0.3);
        --accent-gold: #d4af37;
        --card-bg: rgba(255, 255, 255, 0.05);
    }

    body {
        background: var(--grad-dark); /* Le dégradé sur tout le fond */
        background-attachment: fixed;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        min-height: 100vh;
    }

    /* Barre de navigation stylée */
    .admin-navbar {
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(10px); /* Effet de flou moderne */
        border-bottom: 2px solid var(--accent-gold);
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
    }

    .admin-logo {
        color: var(--accent-gold);
        font-size: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: var(--gold-glow);
    }

    /* Tableaux en mode "Glassmorphism" */
    table {
        width: 100%;
        background: var(--card-bg);
        backdrop-filter: blur(5px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    th {
        background: rgba(212, 175, 55, 0.1);
        color: var(--accent-gold);
        padding: 20px;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    td {
        padding: 15px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    tr:hover {
        background: rgba(255, 255, 255, 0.08);
    }

    /* Bouton Ajouter */
    .btn-add {
        background: linear-gradient(to right, #d4af37, #f2d57e);
        color: #000 !important;
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: bold;
        transition: 0.3s;
        box-shadow: var(--gold-glow);
    }

    .btn-add:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(212, 175, 55, 0.5);
    }
    </style>
</head>
<body>

<header class="admin-navbar">
    <a href="../admin/dashbord_ad.php" class="admin-logo">
        💎 YAPERLUXE <span>ADMIN PANEL</span>
    </a>

    <nav class="admin-menu">
    <a href="dashbord_ad.php"> Dashboard</a>

    <a href="ajouter_produit.php"> Ajouter Produit</a>
    <a href="gestion_commandes.php"> Commandes</a>
    <a href="gestion_utilisateurs.php"> Utilisateurs</a>
</nav>

    <div class="admin-actions">
        <span style="font-size: 0.8rem; color: #888;"> <?= $_SESSION['nom'] ?? 'Admin' ?></span>
        <a href="../index.php" class="btn-site">Voir boutique</a>
        <a href="../deconnexion.php" class="btn-logout"> Quitter</a>
    </div>
</header>

<div class="container">
