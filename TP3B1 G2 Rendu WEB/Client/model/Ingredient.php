<?php
require_once("Objet.php");
class Ingredient extends Objet
{
    protected ?int $IDIngredient;
    protected ?string $NomIngredient;
    protected string $classe = "Ingredient";
    protected string $identifiant = "IDIngredient";

    public function __construct(int $IDIngredient = null, string $NomIngredient = null)
    {
        if (isset($IDIngredient)) {
            $this->IDIngredient = $IDIngredient;
            $this->NomIngredient = $NomIngredient;
        }
    }
}
?>