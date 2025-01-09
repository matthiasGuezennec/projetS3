<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="css/style.css">

  <title>PizzAnanas : Pizzeria en ligne</title>
</head>

<body>
  <?php
  require_once("config/connexion.php");
  require_once("controller/controllerMiseEnAvant.php");
  require_once("model/Produit.php");
  require_once("model/Client.php");

  // créer une session si il n'y en a pas (stock les infos sensible comme le compte utilisé)
  connexion::SESSION();
  connexion::connect();


  include("view/header.php");
  include("view/AccueilDebut.html");


  include("view/vueMiseEnAvant.php");
  include("view/AccueilFin.html");
  include("view/footer.html");
  ?>