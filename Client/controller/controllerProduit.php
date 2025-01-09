<?php
require_once("controllerObjet.php");

class controllerProduit extends controllerObjet
{
    private static string $classe = "Produit";
    private static string $identifiant = "IDProduit";
    /*
        public static function displayIngredients($id)
        {

            $ingredients = Produit::getIngre($id);

            $quant = array_fill(0, count($ingredients), 0);

            foreach ($ingredients as $ingredient) {

                $quant[$ingredient->get("NomIngredient")] = isset($_SESSION[$ingredient->get("NomIngredient")]) ? intval($_POST[$ingredient->get("NomIngredient")]) : 1;
            }

            // Traitement du formulaire
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                foreach ($ingredients as $ingredient) {

                    if (isset($_POST['action_increase_' . $ingredient->get("IDIngredient")])) {

                        IncrVal($quant, $ingredient);
                        foreach ($ingredients as $ingredient)
                            $_SESSION[$ingredient->get("NomIngredient")] = $quant[$ingredient->get("NomIngredient")];

                    } else if (isset($_POST['action_decrease_' . $ingredient->get("IDIngredient")])) {

                        DecrVal($quant, $ingredient);
                        foreach ($ingredients as $ingredient)
                            $_SESSION[$ingredient->get("NomIngredient")] = $quant[$ingredient->get("NomIngredient")];

                    }
                }
            }

            ?>
            <form method="post">
                <?php foreach ($ingredients as $ingredient): ?>

                    <div class="ingredient-container">
                        <?php echo $ingredient->get("NomIngredient"); ?>:
                        <span id="numeric-value">
                            <?php echo $quant[$ingredient->get("NomIngredient")]; ?>
                        </span>

                        <button class="button_add" type="submit" name="action_increase_
                            <?php echo $ingredient->get("IDIngredient"); ?>">+</button>

                        <button class="button_suppr" type="submit" name="action_decrease_
                            <?php echo $ingredient->get("IDIngredient"); ?>">-</button>
                    </div>

                <?php endforeach; ?>
                <input type='hidden' name='id' value='<?php echo $id; ?>'>
                <button class="home-button" type="submit" href="commande.php" name='ajoutCommande'>Ajouter</button>
            </form>
            <?php
        }
        */
    public static function displayIngredients($produit)
    {
        $ingredients = Produit::getIngre($produit);

        // Traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($ingredients as $ingredient) {
                $ingredientKey = $ingredient->get('NomIngredient');

                if (isset($_POST['action_increase_' . $ingredientKey])) {
                    IncrVal($ingredientKey);  // Utilisation de la clé de l'ingrédient
                } elseif (isset($_POST['action_decrease_' . $ingredientKey])) {
                    DecrVal($ingredientKey);  // Utilisation de la clé de l'ingrédient
                }
            }
        }

        ?>
        <form method="post">
            <?php foreach ($ingredients as $ingredient): ?>
                <div class="ingredient-container">
                    <?php echo $ingredient->get('NomIngredient'); ?>:
                    <span id="numeric-value">
                        <?php echo isset($_POST[$ingredient->get('NomIngredient')]) ? $_POST[$ingredient->get('NomIngredient')] : 1; ?>
                    </span>
                    <button class="button_add" type="submit"
                        name="action_increase_<?php echo $ingredient->get('NomIngredient'); ?>">+</button>
                    <button class="button_suppr" type="submit"
                        name="action_decrease_<?php echo $ingredient->get('NomIngredient'); ?>">-</button>
                </div>
            <?php endforeach; ?>
            <!-- ... -->
        </form>
        <?php
    }
}
function IncrVal($ingredientKey)
{
    if (isset($_POST[$ingredientKey])) {
        $_POST[$ingredientKey]++;
    } else {
        $_POST[$ingredientKey] = 1;
    }
}

function DecrVal($ingredientKey)
{
    if (isset($_POST[$ingredientKey]) && $_POST[$ingredientKey] > 0) {
        $_POST[$ingredientKey]--;
    }
}
