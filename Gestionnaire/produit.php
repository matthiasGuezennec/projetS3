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
    require_once("controller/controllerProduit.php");
    require_once("config/connexion.php");
    require_once("model/Produit.php");
    require_once("model/Ingredient.php");
    require_once("model/TypeProduit.php");

    connexion::SESSION();
    connexion::connect();

    if (!isset($_SESSION["Pizzeria"])) {
        header("location: connexion.php");
        exit();
    }

    $nomProduit = "";
    $prixProduit = 0;
    $nbIngredient = 1;

    if (isset($_POST["NomProduit"])) {

        $nomProduit = $_POST["NomProduit"];
        $prixProduit = $_POST["PrixProduit"];
        $nbIngredient = $_POST["nbIngredient"];
    }

    if (isset($_SESSION["nbIngredient"])) {
        $nbIngredient = $_SESSION["nbIngredient"];
    }

    $Pizzeria = unserialize($_SESSION["Pizzeria"]);

    include("view/header2.html");
    include("view/NavBar.html");

    if (isset($_POST["LeProduit"])) {
        TypeProduit::insert($_POST["LeProduit"], $_POST["LeType"]);

    } elseif (isset($_POST["delProduit"])) {
        Produit::delete($_POST["NomProduit"]);

    } elseif (isset($_POST["add_Ing"])) {
        $nbIngredient++;

    } elseif (isset($_POST["del_Ing"])) {
        if ($nbIngredient > 1)
            $nbIngredient--;

    } elseif (isset($_POST["Insert"])) {

        $IDIngredients = [];

        $id = 0;
        while (isset($_POST["AjoutIngredient$id"])) {

            // Ajouter l'ID de l'ingrédient (les chiffres) à $IDIngredient
            $idIngredient = preg_replace("/[^0-9]/", "", $_POST["AjoutIngredient$id"]);
            array_push($IDIngredients, $idIngredient);

            $id++;
        }

        controllerProduit::insert($nomProduit, $prixProduit, $IDIngredients);

        /* Mis de coté car impossible avec les restriction actuel du serveur 
        $uploadDirectory = '../Client/image/';

        $uploadedFile = $_FILES['file']['tmp_name'];
        $destination = $uploadDirectory . basename($_FILES['file']['name']);

        if (move_uploaded_file($uploadedFile, $destination)) {
        } else {
            echo 'Erreur lors du téléchargement du fichier.';
        }
        */
        ?>
        <h2> Nouveau produit ajouté </h2>
        <?php

        $nomProduit = "";
        $prixProduit = 0.00;
        $nbIngredient = 1;
    }

    /*
     *   ICI
     *
     */
    $Ingredients = Ingredient::getAll1($Pizzeria->get("NomPizzeria"));
    include("view/AjoutProduit.php");

    // ****************************
    
    $Produits = Produit::getAll();
    $Types = TypeProduit::getAll();

    include("view/AjoutTypeProduit.php");

    // ****************************
    
    //include("view/DelProduit.php");

    // ****************************
    
    include("view/footer.html");
    ?>
</body>

</html>