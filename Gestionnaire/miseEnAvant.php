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

connexion::SESSION();
connexion::connect();


if (!isset($_SESSION["Pizzeria"])) {
    header("location: connexion.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["produitMEA"])) {
    
    $num = $_POST["produitMEA"];
    $num = preg_replace("/[^0-9]/", "", $num);

    controllerMiseEnAvant::del($num);
}
// on ajoute la mise en avant du produit 
else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["produit_Add_MEA"])) {

    // en paramètre : conversion en int de l'ensemble des valeur numérique du string $_POST["produit_Add_MEA"]

    controllerMiseEnAvant::add( intval ( preg_replace ("/[^0-9]/", "", $_POST["produit_Add_MEA"] ) ) ) ;

    // réactualisation de la page pour affiché le nouveau produit mis en avant
    header("location: miseEnAvant.php");
    exit();
}
$Pizzeria = unserialize($_SESSION["Pizzeria"]);
include("view/header2.html");
include("view/NavBar.html");
// recupère toutes les mises en avants

echo "<div class='connexionForm'>";
include("view/vueMiseEnAvant.php");
echo "</div>";

$produits = controllerMiseEnAvant::getAll();


include("view/MiseEnAvant.php");

// Prend tous les produits qui ne sont pas mis en avant
$leProduit = Produit::getAll_forMEA();

include ("view/AjoutMiseEnAvant.php");

// ************************************
include("view/footer.html");
?>

</body>

</html>