<?php
require_once("Objet.php");
class Alerte extends Objet {
    protected ?int $IDAlerte;
    protected ?string $NomIngredient;
    protected ?DateTime $DateAlerte;
    protected string $classe = "Alerte";
    protected string $identifiant = "IDAlerte";

    public function __construct(int $IDAlerte = null, int $NomIngredient = null, DateTime $DateAlerte = null) {
        if ($IDAlerte !== null) {
            $this->IDAlerte = $IDAlerte; 
            $this->IDIngredient = $NomIngredient;
            $this->DateAlerte = $DateAlerte;
        }
    }
    public function __toString() : string {
        return "Alerte n°" . $this->IDAlerte . " - " . $this->NomIngredient . " ( " . date_format($this->DateAlerte, "d-m-Y h:i:s") . " )";
    }
}
?>