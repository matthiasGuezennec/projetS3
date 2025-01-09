<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/MEA/style.css">

    <title>Gestion - pizzAnananas</title>
</head>

<body>
    <?php
    require_once("model/Pizzeria.php");
    require_once("controller/controllerMiseEnAvant.php");
    require_once("config/connexion.php");
    require_once("model/Produit.php");
    require_once("model/Promotion.php");
    connexion::SESSION();
    connexion::connect();


    if (!isset($_SESSION["Pizzeria"])) {
        header("location: connexion.php");
        exit();
    }
    $Pizzeria = unserialize($_SESSION["Pizzeria"]);
    include("view/header2.html");
    include("view/NavBar.html");
        /*
         *   ICI
         *
        */
        // affichage de la semaine 
        $produits = Produit::getAll_NB_1SEM();
        $total = Produit::Total_1SEM();

        echo "<h1>Commandes de la semaine : </h1>";

        include("view/InfoProduit.php");

        // affichage du mois 
        $produits = Produit::getAll_NB_1MONTH();
        $total = Produit::Total_1MONTH();

        echo "<h1>Commandes du mois : </h1>";

        include("view/InfoProduit.php");

        include("view/footer.html");
        ?>

    </div>
</body>

</html>