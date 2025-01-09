<h2>Ajout d'une promotion sur des produits </h2>

<form method='post' class='connexionForm'>
    <p> La date de début</p>
    <input type='date' name='DateDebPromotion' />

    <p> La date de fin</p>
    <input type='date' name='DateFinPromotion' />

    <?php for ($i = 0; $i < $nbProduits; $i++): ?>
        <select name='TypeProduit_<?php echo $i;?>'>
            <?php foreach ($TypeProduits as $produit): ?>

                <element>
                    <?php echo $produit; ?>
            </element>

            <?php endforeach; ?>
        </select>
    <?php endfor;
    ?>

    <button type='submit' name="AjoutType">Ajouter un Autre type de produit</button>
    <button type='submit' name='Ajout'>Ajouter</button>
</form>