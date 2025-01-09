<!-- affiche tous les produits -->

<?php
foreach ($tableau as $produits): ?>
    <div class=<?php 
    if (isset($_GET["id"]) && $produits->get("IDProduit") == $_GET["id"])
    echo "'block_act'";
    else 
    echo "'block'";
?>>
        <a href=<?php 
        if (isset($_GET["id"]) && $produits->get("IDProduit") == $_GET["id"])
        echo "commande.php";
        else 
        echo "commande.php?id=" . $produits->get("IDProduit");
    ?> class="Pizza-button">
            <h3>
                <?php echo $produits->get("NomProduit"); ?>
                <h3>
                    <img class="pizzas" <?php echo "src='image/" . $produits->get("NomProduit") . ".webp'"; ?> alt=<?php echo "'" . $produits->get("NomProduit") . "'"; ?> />
                    <p>
                        <?php echo $produits->get("PrixProduit"); ?> €
                    </p>
        </a>
    </div>
<?php endforeach; ?>