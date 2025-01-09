<form class="connexionForm" type="post">
    <h2>Suppression d'un produit</h2>
    <select name="NomProduit">
        <?php foreach ($Produits as $produit):
            // on ne l'affiche pas si c'est un produit dynamique (insérer dans la base de données lors de l'ajout d'un produit modifié)
            if ("produit_dynamique_" . preg_replace("/[^0-9]/", "", $produit->get("NomProduit")) != $produit->get("NomProduit")): ?>
                <option name="NomProduit">
                    <?php echo $produit->toString(); ?>
                </option>
            <?php endif;
        endforeach; ?>
    </select> <br> 
    <button type="submit" name="delProduit">Supprimer</button>
</form>