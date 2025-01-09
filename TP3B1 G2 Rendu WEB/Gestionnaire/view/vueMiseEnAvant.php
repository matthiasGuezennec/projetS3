<h2>Les Produits actuellement en avant sur le site : </h2>
<form class='container'>
  <?php
  $line = controllerMiseEnAvant::getLine();
  for ($i = $line; $i > $line - 4; $i--) {
    echo "<div class=\"block\">";

    $Produit = controllerMiseEnAvant::getOne($i);

    $nom = $Produit->get("NomProduit");

    $idProduit = $Produit->get("IDProduit");

    echo "<a class=\"Pizza-button\">";

    echo "<h3>$nom</h3>";
    echo "<img class=\"pizzas\" src=\"image/$nom.webp\" alt=\"$nom\"/>";


    $prix = $Produit->get("PrixProduit");

    ?>
      <a type='submit' name='supprimer' <?php echo "href=\"accueil.php?id=$idProduit\"" ; ?> >remplacer</a>
    <?php
    echo "<p>$prix €</p>";
    echo "</a></div>";
  }
  ?>
</form>