<?php
session_start();
include 'include/db_connect.php';

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // On cherche l'utilisateur par son email
    $sql = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Le mot de passe est bon ! On crée la session
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['photo'] = $user['photo_profil'];

        // Redirection vers le Dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Erreur
        header("Location: connexion.php?error=1");
        exit();
    }
}