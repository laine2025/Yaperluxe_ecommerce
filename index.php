<?php 
// D'abord, je me  connecte à la base de données
include 'include/db_connect.php'; 

// je récupère tous les produits
$sql = "SELECT * FROM produits";
$stmt = $pdo->query($sql);
$produits = $stmt->fetchAll();

// Ensuite, j'inclus le header
include 'include/header.php'; 
?>
<header class="btn-grad" style=" display:flex;justify-content:space-around;padding:10px 20px;margin:10px 40px;margin-top: 100px;border-radius:10px;height:80vh">
    <div class="text" style="width: 100%;text-align: center;">
        <h2 style="margin-top: 20vh;color:#fff">Bienvenue sur ShopEsa</h2>
        <p style="color: #fff;line-height: 2em;font-size:17px;padding: 0 20px;">
            ShopEsa vous offre des produits de qualités. 
            Découvrez notre collection de bijoux et accessoires uniques, conçus pour sublimer votre style.
             Profitez de nos offres exclusives et faites-vous plaisir avec nos créations élégantes et tendance.
        </p>


        <div class="begin" style="background-color: #fff;display:flex;padding:10px 10px;border-radius:10px;margin-top: 20px;justify-content: space-around;width:70%;margin-left: 13%;margin-top:100px">
            <a href="#container" class="btn-grad" style="padding: 10px 20px; font-size: 18px; text-decoration: none; color: white; border-radius: 5px;">Boutique</a>
          <?php if(isset($_SESSION['user_id'])): ?>
            <a href="panier.php" class="btn-grad" style="padding: 10px 20px; font-size: 18px; text-decoration: none; color: white; border-radius: 5px;">Voir Panier</a>
          <?php endif; ?>
        </div>
    </div>
    <div class="image" style="width: 100%;">
        <img src="cheville_1.jfif" alt="" style="width: 100%;border-radius:10px;height:80vh">
    </div>
</header>

<div class="container" style="padding: 50px;">
    <h2 style="text-align:center; font-size: 3rem;">Nos Bijoux & Accessoires</h2>
    <div class="filter-container" style="text-align: center; margin: 40px 0;">
    <style>
        .filter-btn {
            background: none;
            border: 2px solid #D4AF37;
            color: #D4AF37 !important;
            padding: 10px 25px;
            margin: 8px;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-weight: bold;
            font-family: sans-serif;
        }

        .filter-btn:hover, .filter-btn.active {
            background: #D4AF37;
            color: #000 !important;
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
        }
    </style>

    <a href="index.php" class="filter-btn <?= !isset($_GET['categorie']) ? 'active' : '' ?>"> Tous</a>
    <a href="index.php?categorie=Colliers" class="filter-btn <?= ($_GET['categorie'] ?? '') == 'Collier' ? 'active' : '' ?>"> Colliers</a>
    <a href="index.php?categorie=Bayas" class="filter-btn <?= ($_GET['categorie'] ?? '') == 'Bayas' ? 'active' : '' ?>"> Bayas</a>
    <a href="index.php?categorie=Chevillèret" class="filter-btn <?= ($_GET['categorie'] ?? '') == 'Chevillères' ? 'active' : '' ?>">Chevilleres</a>
    <a href="index.php?categorie=Beads" class="filter-btn <?= ($_GET['categorie'] ?? '') == 'Beads' ? 'active' : '' ?>">Perles</a>
    <a href="index.php?categorie=Boucles" class="filter-btn <?= ($_GET['categorie'] ?? '') == 'Boucles' ? 'active' : '' ?>">Boucles</a>
   </div>
   </div>
   </div>

    <div class="grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
        
        <?php 
        // Ici j'ai fait une boucle pour afficher chaque produit
        foreach ($produits as $produit) : 
        ?>
            <div class="glass-card" onclick="ouvrirModale('<?= $produit['nom_prod'] ?>', 'uploads/produits/<?= $produit['image_prod'] ?>', '<?= $produit['prix'] ?>', '<?= $produit['description'] ?? 'Magnifique bijou Yaperluxe' ?>')">
                <img src="uploads/produits/<?php echo $produit['image_prod']; ?>"  style="width:100%; border-radius:15px; height: 200px; object-fit: cover;"alt="<?php echo $produit['nom_prod']; ?>">

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
// Mon code JavaScript évolue pour gérer l'ID et l'image
function addToCart(id, name, price, image) {
    // je récupère le panier actuel
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // J'ajoute le nouveau produit avec toutes ses infos
    cart.push({id, name, price, image});
    
    // j'enregistre
    localStorage.setItem('cart', JSON.stringify(cart));
    
    updateCartCount();
    
    // Petite animation 
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