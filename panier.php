<?php 
session_start();
include 'include/header.php'; 
?>

<div class="container glass-card" style="margin: 50px;">
    <h2>🛒 Votre Panier</h2>
    <div id="liste-panier">
    </div>
    <hr>
    <div id="panier-total"></div>

    <?php if(isset($_SESSION['id_user'])): ?>
        <button class="btn-grad" onclick="validerCommande()">Confirmer et Payer</button>
    <?php else: ?>
        <p>Veuillez vous <a href="connexion.php" style="color: #fd1d1d;">connecter</a> pour commander.</p>
    <?php endif; ?>
</div>

<script>
function supprimerDuPanier(index) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // On retire l'élément à l'index donné
    cart.splice(index, 1);
    
    // On sauvegarde le nouveau panier dans le localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // On relance l'affichage pour mettre à jour la liste et le total
    afficherPanier();
}
// Affiche le contenu du panier au chargement
function afficherPanier() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let list = document.getElementById('liste-panier');
    let total = 0;

    if(cart.length === 0) {
        list.innerHTML = "<p>Votre panier est vide.</p>";
        return;
    }

    list.innerHTML = cart.map((item, index) => {
    total += parseFloat(item.price);
    return `
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding: 10px; background: rgba(255,255,255,0.1); border-radius: 8px;">
            <div>
                <p style="margin: 0;"><strong>${item.name}</strong></p>
                <p style="margin: 0; color: #fcb045;">${item.price} F CFA</p>
            </div>
            <button onclick="supprimerDuPanier(${index})" 
                    style="background: linear-gradient(45deg, #833ab4, #fd1d1d); color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                Supprimer
            </button>
        </div>
    `;
}).join('');
    
    document.getElementById('panier-total').innerHTML = `<h3>Total : ${total.toFixed(2)} F CFA</h3>`;
}

// FONCTION CRUCIALE : Envoie les données au PHP
function validerCommande() {
    let cart = JSON.parse(localStorage.getItem('cart'));

    // On utilise fetch pour envoyer le JSON à PHP
    fetch('valider_commande.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(cart)
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert("Commande réussie !");
            localStorage.removeItem('cart'); // On vide le panier local
            window.location.href = "dashboard.php";
        } else {
            alert("Erreur : " + data.message);
        }
    });
}

afficherPanier();
</script>

<?php include 'include/footer.php'; ?>