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
// Affiche le contenu du panier au chargement
function afficherPanier() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let list = document.getElementById('liste-panier');
    let total = 0;

    if(cart.length === 0) {
        list.innerHTML = "<p>Votre panier est vide.</p>";
        return;
    }

    list.innerHTML = cart.map(item => {
        total += parseFloat(item.price);
        return `<p><strong>${item.name}</strong> - ${item.price} F CFA</p>`;
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