<?php 
session_start();
include 'include/header.php'; 
?>

<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 90vh; padding: 20px;">
    <div class="glass-card" style="width: 100%; max-width: 450px; position: relative; overflow: hidden;">
        
        <form action="traitement.php" method="POST" enctype="multipart/form-data">
            <h2 style="text-align: center; margin-bottom: 25px; background: var(--grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Créer un compte</h2>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; opacity: 0.8;">Pseudo</label>
                <input type="text" name="username" required placeholder="Ex: TechMaster" 
                       style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: white;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; opacity: 0.8;">Email</label>
                <input type="email" name="email" required placeholder="votre@email.com" 
                       style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: white;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; opacity: 0.8;">Mot de passe</label>
                <input type="password" name="password" required placeholder="••••••••" 
                       style="width: 100%; padding: 12px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: white;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px; opacity: 0.8;">Photo de profil</label>
                <input type="file" name="photo" accept="image/*" 
                       style="width: 100%; color: rgba(255,255,255,0.5); font-size: 0.9rem;">
            </div>

            <button type="submit" name="register" class="btn-grad" style="width: 100%; padding: 15px; border-radius: 10px; font-size: 1rem;">
                S'INSCRIRE MAINTENANT
            </button>

            <p style="text-align: center; margin-top: 20px; font-size: 0.9rem; opacity: 0.7;">
                Déjà membre ? <a href="connexion.php" style="color: #fd1d1d; text-decoration: none; font-weight: bold;">Se connecter</a>
            </p>
        </form>
    </div>
</div>

<?php include 'include/footer.php'; ?>