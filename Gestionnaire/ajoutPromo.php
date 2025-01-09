<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/MEA/style.css">

    <title>Ajout promotions - pizzAnananas</title>
</head>
<body>
<?php
require_once("model/Pizzeria.php");
require_once("controller/controllerMiseEnAvant.php");
require_once("config/connexion.php");
require_once("model/Produit.php");
connexion::SESSION();
connexion::connect();

$TypeProduits = array();
if (!isset($_SESSION["Pizzeria"])) {
    header("location: connexion.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    controllerMiseEnAvant::del($_GET["id"]);
}
$Pizzeria = unserialize($_SESSION["Pizzeria"]);

include("view/header2.html");
include("view/NavBar.html");

// affichage des produits mise en avant 

include("view/FormulairePromotion.php");

// ************************************

include("view/footer.html");
?>

</body>

</html>