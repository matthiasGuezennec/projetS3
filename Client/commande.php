<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/style.css">

    <title>Pizzeria en ligne</title>
</head>

<body>
    <?php

    require_once("config/connexion.php");
    require_once("controller/controllerProduit.php");
    require_once("model/Produit.php");
    require_once("model/Client.php");
    require_once("model/Ingredient.php");
    require_once("model/Commande.php");


    connexion::SESSION();
    connexion::connect();

    include("view/header.php");

    // ajout du produit dans la commande
    if (isset($_POST["ajoutCommande"])) {
        if (isset($_SESSION["Commande"])) {

            $Commande = $_SESSION["Commande"];
            $Commande->add($_GET["id"]);

            $_SESSION["Commande"] = $Commande;
            unset($_GET["id"]);
        }
    } else if (isset($_POST["retirer"])) {
        $Commande = $_SESSION["Commande"];

        $Commande->del($_GET["id"]);

        $_SESSION["Commande"] = $Commande;
        unset($_GET["id"]);
    } else
        // fais l'affichage du produit selectionné 
        if (isset($_GET["id"])) {

            $produit = Produit::getOne($_GET["id"]);
            include("view/AfficherProduit.php");
        }

        
    include("view/DebutCommande.php");

    $tableau = Produit::getGrandePizzas();
    ?>
    <a href='ConfirmCommande.php' class='Confirm-Commande'>Confirmer la commande</a>
    <br>
    <h1 id="grandePizza"> Nos grandes Pizzas </h1><br><br>

    <div class="container">
        <?php

        include("view/VueCommande.php");

        // SEPARATION
        $tableau = Produit::getMoyennePizzas();
        ?>
        <br>
    </div>
    <h1 id="moyennePizza"> Nos Pizzas de taille moyenne</h1><br><br>

    <div class="container">
        <?php

        include("view/VueCommande.php");

        // SEPARATION
        $tableau = Produit::getPetitePizzas();
        ?>
        <br>
    </div>
    <h1 id="petitePizza"> Nos petites Pizzas</h1><br><br>

    <div class="container">
        <?php

        include("view/VueCommande.php");

        // SEPARATION
        $tableau = Produit::getBoissons();
        ?>
        <br>
    </div>
    <h1 id="boissons"> Nos boissons</h1><br><br>

    <div class="container">
        <?php

        include("view/VueCommande.php");

        // SEPARATION
        $tableau = Produit::getDesserts();
        ?>
        <br>
    </div>
    <h1 id="desserts"> Nos Desserts</h1><br><br>

    <div class="container">
        <?php

        include("view/VueCommande.php");

        echo "</div></section>";
        ?>
        <?php
        include("view/footer.html");
        ?>