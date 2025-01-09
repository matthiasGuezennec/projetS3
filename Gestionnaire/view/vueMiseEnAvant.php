<h2>Les Produits actuellement en avant sur le site : </h2>
<form class='container'>
  <?php
  $Produits = controllerMiseEnAvant::getMEA();

  foreach ($Produits as $Produit) {
    echo "<div class=\"block\">";
  
  
    $nom = $Produit->get("NomProduit");
  
    $idProduit = $Produit->get("IDProduit");
  
    echo "<a href=\"miseEnAvant.php\"  class=\"Pizza-button\">";
  
    echo "<h3>$nom</h3>";
    echo "<img class=\"pizzas\" src=\"image/$nom.webp\" alt=\"$nom\"/>";
  
  
    $prix = $Produit->get("PrixProduit");
  
    echo "<p>$prix €</p>";
    echo "</a></div>";
  }
  ?>
</form>