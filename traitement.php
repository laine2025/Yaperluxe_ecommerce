<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libs/PHPMailer/Exception.php';
require 'libs/PHPMailer/PHPMailer.php';
require 'libs/PHPMailer/SMTP.php';

include 'include/db_connect.php'; // Charge la BD et le .env

if (isset($_POST['register'])) {
    $pseudo = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Gestion de l'upload de la photo de profil
    $photo_nom = "default.png";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photo_nom = "profil_" . time() . "." . $extension;
        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/profils/" . $photo_nom);
    }

    try {
        // 1. Insertion en base de données
        $sql = "INSERT INTO utilisateurs (pseudo, email, password, photo_profil) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$pseudo, $email, $password, $photo_nom]);

        // 2. Préparation du Mail avec PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';               
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'mamoudouzakiya1956@gmail.com';            
        $mail->Password   = 'gxkc flgb ibmx kyhn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom('mamoudouzakiya1956@gmail.com', 'YAPERLUXE');
        $mail->addAddress($email);

        // Design du mail (on reprend tes dégradés !)
        $mail->isHTML(true);
        $mail->Subject = "Bienvenue dans l'univers de YAPERLUXE, $pseudo !";
        $mail->Body = "
            <div style='background: #0b0118; color: white; padding: 40px; font-family: sans-serif; text-align: center; border-radius: 20px;'>
                <h1 style='background: linear-gradient(45deg, #833ab4, #fd1d1d, #fcb045); -webkit-background-clip: text; color: #fd1d1d; font-size: 30px;'>BIENVENUE CHEZ YAPERLUXE</h1>
                <p style='font-size: 18px; opacity: 0.8;'>Ton compte a été créé avec succès.</p>
                <div style='margin: 30px 0;'>
                    <a href='http://localhost/PROJET/connexion.php' 
                       style='background: linear-gradient(45deg, #833ab4, #fd1d1d); color: white; padding: 15px 30px; text-decoration: none; border-radius: 50px; font-weight: bold;'>
                       Se connecter à mon compte
                    </a>
                </div>
                <p style='font-size: 12px; opacity: 0.5;'>Ceci est un mail automatique, merci de ne pas répondre.</p>
            </div>
        ";

        $mail->send();
        header("Location: connexion.php?success=1");

    } catch (Exception $e) {
        // Si le mail échoue, on enregistre quand même mais on prévient
        header("Location: connexion.php?error=mail_failed");
    }
}