<?php
$Produits = controllerMiseEnAvant::getMEA();

foreach ($Produits as $Produit) {
  echo "<div class=\"block\">";


  $nom = $Produit->get("NomProduit");

  $idProduit = $Produit->get("IDProduit");

  echo "<a href=\"commande.php?id=$idProduit\"  class=\"Pizza-button\">";

  echo "<h3>$nom</h3>";
  echo "<img class=\"pizzas\" src=\"image/$nom.webp\" alt=\"$nom\"/>";


  $prix = $Produit->get("PrixProduit");

  echo "<p>$prix €</p>";
  echo "</a></div>";
}
?>