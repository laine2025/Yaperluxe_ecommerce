<?php 
session_start();
include 'include/header.php'; 
?>

<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    <div class="glass-card" style="width: 100%; max-width: 400px;">
        <form action="traitement_connexion.php" method="POST">
            <h2 style="text-align: center; margin-bottom: 30px;">Connexion</h2>
            
            <?php if(isset($_GET['success'])): ?>
                <p style="color: #00ff88; text-align: center;">Inscription réussie ! Connectez-vous.</p>
            <?php endif; ?>
            
            <?php if(isset($_GET['error'])): ?>
                <p style="color: #ff4d4d; text-align: center;">Identifiants incorrects.</p>
            <?php endif; ?>

            <div class="input-box" style="margin-bottom: 20px;">
                <input type="email" name="email" placeholder="Email" required 
                       style="width: 100%; padding: 10px; background: rgba(255,255,255,0.1); border: none; border-radius: 5px; color: white;">
            </div>

            <div class="input-box" style="margin-bottom: 20px;">
                <input type="password" name="password" placeholder="Mot de passe" required 
                       style="width: 100%; padding: 10px; background: rgba(255,255,255,0.1); border: none; border-radius: 5px; color: white;">
            </div>

            <button type="submit" name="login" class="btn-grad" style="width: 100%;">Se connecter</button>
            
            <p style="text-align: center; margin-top: 20px; font-size: 14px;">
                Pas encore de compte ? <a href="inscription.php" style="color: #fd1d1d;">S'inscrire</a>
            </p>
        </form>
    </div>
</div>

<?php include 'include/footer.php'; ?>