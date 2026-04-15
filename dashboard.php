<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: connexion.php");
    exit();
}
include 'include/header.php';
?>

<div class="container" style="padding: 50px; color: white;">
    <div class="glass-card">
        <h1>Bienvenue sur ton Dashboard, <?php echo $_SESSION['pseudo']; ?> !</h1>
        <p>Tu es maintenant connecté.</p>
        <img src="uploads/profils/<?php echo $_SESSION['photo']; ?>" style="width: 100px; border-radius: 50%;">
    </div>
</div>

<?php include 'include/footer.php'; ?>