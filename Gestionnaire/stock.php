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
    require_once("model/Ingredient.php");
    connexion::SESSION();
    connexion::connect();


    if (!isset($_SESSION["Pizzeria"])) {
        header("location: connexion.php");
        exit();
    }

    $Pizzeria = unserialize($_SESSION["Pizzeria"]);
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["NomIngredient"])) {
        echo "test";
        Ingredient::insertNew($_POST["NomIngredient"]);
    } else
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nb = intval($_POST["NbAjout_Stock"]);

            Ingredient::addStock($nb, $Pizzeria->get('NomPizzeria'));
        }
    include("view/header2.html");
    include("view/NavBar.html");
    /*
     * ************************************
     *   ICI
     *
     */
    $Ingredients = Ingredient::getAll1($Pizzeria->get("NomPizzeria"));

    include("view/VueStock.php");
    // ***********************************
    include("view/AjoutStock.html");
    // ***********************************
    include("view/AjoutIngredient.html");
    include("view/footer.html");
    ?>

</body>

</html>