<?php 
// D'abord, je me  connecte à la base de données
include 'include/db_connect.php'; 

// je récupère tous les produits de beauté
$sql = "SELECT * FROM produits";
$stmt = $pdo->query($sql);
$produits = $stmt->fetchAll();

// Ensuite, j'inclus le header
include 'include/header.php'; 
?>

<div class="container" style="padding: 50px;">
    <h2 style="text-align:center; font-size: 3rem;">Nos Bijoux & Accessoires</h2>

    <div class="grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
        
        <?php 
        // Ici j'ai fait une boucle pour afficher chaque produit
        foreach ($produits as $produit) : 
        ?>
            <div class="glass-card">
                <img src="uploads/produits/<?php echo $produit['image_prod']; ?>" 
                     style="width:100%; border-radius:15px; height: 200px; object-fit: cover;"
                     alt="<?php echo $produit['nom_prod']; ?>">

                <h3 style="margin-top: 15px;"><?php echo $produit['nom_prod']; ?></h3>

                <p style="opacity:0.7;">Catégorie: <?php echo $produit['categrie']; ?></p>
                
                <p style="font-size: 0.9rem; margin-bottom: 10px;"><?php echo substr($produit['description'], 0, 80) . '...'; ?></p>

                <p style="font-weight:bold; color:#fd1d1d; font-size: 1.2rem;"><?php echo number_format($produit['prix'], 0, ',', ' '); ?> F CFA</p>
                
                <button class="btn-grad" 
                        onclick="addToCart(
                            <?php echo $produit['id_prod']; ?>, 
                            '<?php echo addslashes($produit['nom_prod']); ?>', 
                            <?php echo $produit['prix']; ?>,
                            '<?php echo $produit['image_prod']; ?>'
                        )">
                    Ajouter au panier
                </button>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<script>
// Mon code JavaScript doit évoluer pour gérer l'ID et l'image
function addToCart(id, name, price, image) {
    // je récupère le panier actuel
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // J'ajoute le nouveau produit avec toutes ses infos
    cart.push({id, name, price, image});
    
    // j'enregistre
    localStorage.setItem('cart', JSON.stringify(cart));
    
    updateCartCount();
    
    // Petite animation optionnelle
    alert(name + " a été ajouté au panier !");
}

function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    // je vérifie si l'élément existe avant de modifier son texte
    const cartCountEl = document.getElementById('cart-count');
    if (cartCountEl) {
        cartCountEl.innerText = cart.length;
    }
}

// je met à jour le compteur au chargement de la page
updateCartCount();
</script>

<?php include 'include/footer.php'; ?>