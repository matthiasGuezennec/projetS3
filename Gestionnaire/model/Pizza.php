<?php
require_once("Objet.php");

// une Pizza n'est pas forcément une pizza (oui j'ai oublié avant de tout faire)
class Pizza extends Objet
{
    protected ?int $idPizza;
    protected ?string $nomPizza;
    protected ?float $prixPizza;
    protected static string $classe = "pizza";
    public function __construct(int $idPizza = null, string $nomPizza = null, float $prixPizza = null)
    {
        if (!is_null($idPizza)) {
            $this->idPizza = $idPizza;
            $this->nomPizza = $nomPizza;
            $this->prixPizza = $prixPizza;
        }
    }
    public function __toString() :string {
        return $this->nomPizza;
    }
}
?>