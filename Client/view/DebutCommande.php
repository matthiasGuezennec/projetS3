<section>
  <div class="left">
    <a href="commande.php#grandePizza" class="redirection">Nos Grande Pizzas</a> <br>
    <a href="commande.php#MoyennePizza" class="redirection">Nos Moyenne Pizzas</a><br>
    <a href="commande.php#petitePizza" class="redirection">Nos Petite Pizzas</a><br>
    <a href="commande.php#boissons" class="redirection">Nos Boissons</a><br>
    <a href="commande.php#desserts" class="redirection">Nos Desserts</a><br>

    <h2 class="TitreCommande">Votre Commande : </h2>
    <a href='ConfirmCommande.php' class='Confirm-Commande'>Confirmer</a>
    <?php
    $commandes = new Commande();

    // recupère les infos de la commande mais si il n'y en a pas, on créer la variable stocké dans $_SESSION
    
    if (isset($_SESSION["Commande"])) {

      $commandes = $_SESSION["Commande"];
    } else {

      $date = new DateTime();
      $date->setTimezone(new DateTimeZone('Europe/Paris'));

      $Commandes = new Commande(0, $date, array());
      $_SESSION["Commande"] = $Commandes;

    }

    $id = 0;
    $produits = $commandes->get("Produits");
    ?>
    <form method='post'>
      <?php
      foreach ($produits as $commande): ?>
        <h3 class='Produit'>

          <?php echo 1 . " : " . $commande->get("NomProduit"); ?>

        </h3>

        <button name='retirer' class="button" type="submit" formaction="<?php echo 'commande.php?id=' . $id; ?>">Retirer</button>

        <br>
        <br>
        <br>


        <?php
        $id++;
      endforeach; ?>
    </form>
  </div>

  <div class="right">

    <h2>Commandez vos pizzas en ligne</h2>