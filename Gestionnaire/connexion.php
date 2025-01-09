<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/style.css">

    <title>Gestion - pizzAnanans</title>
</head>
<?php
require_once("model/Pizzeria.php");
require_once("config/connexion.php");

connexion::SESSION();
connexion::connect();
if (isset($_SESSION["Pizzeria"])) {
    header("location: accueil.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] ==="POST") {
    $Nom = $_POST["NomPizzeria"];

    if (!is_null($Pizzeria = Pizzeria::verifNom($Nom))) {
        $_SESSION["Pizzeria"] = serialize($Pizzeria);

        header("location: accueil.php");
        exit();
    } else {
        echo"<h1>Nom entré incorrect</h1>";
    }
}

include("view/header.html");

$Pizzeria = Pizzeria::getAll();
echo"<div class='content'><br><br><br>";
include("view/Connexion.php");
echo"</div>";

include("view/footer.html");
?>

</body>
</html>