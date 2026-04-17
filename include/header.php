<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>YAPERLUXE - MA BOUTIQUE DE BIJOUX EN LIGNE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="blob" style="top: -100px; left: -100px;"></div>
    <div class="blob" style="bottom: -100px; right: -100px;"></div>
    
    <nav style="display: flex; justify-content: space-between; padding: 20px 50px; background: rgba(0,0,0,0.3);">
        <h1 style="background: var(--grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">YAPERLUXE</h1>
        <div>
            <a href="index.php" style="color:white; margin-right:20px;">Boutique</a>
            <a href="panier.php" style="color:white; margin-right:20px;">Panier (<span id="cart-count">0</span>)</a>
            <a href="connexion.php" class="btn-grad">Connexion</a>
        </div>
        <?php if(isset($_SESSION['id_user'])): ?>
        <a href="deconnexion.php" class="btn-logout">Déconnexion</a>
        <?php endif; ?>
    </nav>