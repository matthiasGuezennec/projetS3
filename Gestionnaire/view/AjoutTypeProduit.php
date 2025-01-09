<form class="connexionForm" method="post">
    <h2>Ajout d'un type aux produits</h2><br><br>
    <p>⚠️ Il est nécessaire d'ajouter le type de produit pour l'afficher dans le menu de commande ⚠️</p><br><br>
    <select name="LeProduit">
        <?php foreach ($Produits as $produit):
            // on ne l'affiche pas si c'est un produit dynamique (insérer dans la base de données lors de l'ajout d'un produit modifié)
            if ("produit_dynamique_" . preg_replace("/[^0-9]/", "", $produit->get("NomProduit")) != $produit->get("NomProduit")): ?>
                <option>
                    <?php echo $produit->toString(); ?>
                </option>
            <?php endif;
        endforeach; ?>
    </select> <br> <br>
    <select name="LeType">
        <?php foreach ($Types as $type): ?>
            <option>
                <?php echo $type; ?>
            </option>
        <?php endforeach; ?>
    </select><br> <br>
    <button type="submit" name="AddTypeProduit">Attribuer le type</button><br>
</form>