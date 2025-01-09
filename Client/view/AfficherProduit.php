<!-- Affichage de l'image du produit a gauche et des ingrédients à droite avec un bouton '+' et un bouton '-' pour la quantité -->
<div class='affichageProduit'>
    <div class="left">
        <img class="pizza-image" src="image/<?php echo $produit->get("NomProduit"); ?>.webp" />

        <link rel="stylesheet" href="css/AfficherProduit/style.css">
    </div>
    <div class="right">
        <?php
        $nom = $produit->get("NomProduit");

        echo "<h2>$nom<h2>";

        // affiche les ingrédients du produit
        controllerProduit::displayIngredients($produit->get("IDProduit"));
        $produit->getAllergenes();
        $produit->displayAllergene();
        $_SESSION["produit"] = $produit;
        ?>
    </div>
</div>