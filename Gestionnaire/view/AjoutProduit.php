<form method="post" class="connexionForm" enctype="multipart/form-data">
    <h2> Ajout d'un nouveau produit</h2> 

    <input type="hidden" name="nbIngredient" value="<?php echo $nbIngredient; ?>" />

    <input type="text" name="NomProduit" maxlength="20" value="<?php echo $nomProduit; ?>" required /> <br><br>
    <input type="number" name="PrixProduit" maxlength="11" min="0" step="any" value="<?php echo $prixProduit; ?>"
        required /> <br><br>

    <!-- $nbIngredients est le nombre d'ingredient selectionné dans le nouveau produit stocké dans $_Server en attendant l'ajout dans la BD -->
    <?php for ($i = 0; $i < $nbIngredient; $i++): ?>

        <select name="AjoutIngredient<?php echo $i; ?>">
            <?php foreach ($Ingredients as $ingredient): ?>
                <option required>
                    <?php echo $ingredient->toString(); ?>
                </option>
            <?php endforeach; ?>
        </select> <br><br>

    <?php endfor; ?>
    <!-- Impossible d'ajouter le fichier 
    <label for="file">⚠️Il faut impérativement que le nom de l'image soit exactement pareil que le nom du produit et que le fichier soit un .webp ⚠️</label>
    <input type="file" name="file" id="file" accept=".webp" /> <br><br>
            -->
    <button type="submit" name="add_Ing">Ajouter un autre ingrédient</button>
    <button type="submit" name="del_Ing">retirer un ingredient </button><br><br>
    <button type="submit" name="Insert">Confirmer l'ajout</button>
</form>