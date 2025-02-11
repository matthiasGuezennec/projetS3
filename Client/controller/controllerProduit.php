<?php
require_once("controllerObjet.php");

class controllerProduit extends controllerObjet
{
    private static string $classe = "Produit";
    private static string $identifiant = "IDProduit";

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

        // on sort pour créer l'affichage sans faire d'echo 
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
            <button class="home-button" type="submit"href="commande.php" name='ajoutCommande'>Ajouter</button>
        </form>
        <?php
    }
}
// incrémenter la quantité d'un ingrédient pour la personnalisation des 
function IncrVal(&$quant, $ing)
{
    $quant[$ing->get("NomIngredient")]++;
}
function DecrVal(&$quant, $ing)
{

    if ($quant[$ing->get("NomIngredient")] > 0) {

        $quant[$ing->get("NomIngredient")]--;
    }
}
?>