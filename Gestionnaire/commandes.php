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
require_once("model/Commande.php");
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
$produits = Commande::getAll1($Pizzeria->get("NomPizzeria"));
?>
<div class="connexionForm">
<?php include("view/VueCommandes.php"); ?>
</div>
<?php
include("view/footer.html");
?>

</body>

</html>