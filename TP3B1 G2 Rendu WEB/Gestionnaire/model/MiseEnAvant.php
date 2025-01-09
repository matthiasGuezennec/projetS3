<?php
    require_once("Objet.php");
    class MiseEnAvant extends Objet {
        protected ?int $idMEA;
        protected ?int $idPizza;

        protected static string $classe = "MiseEnAvant";
        public function __construct(int $idMEA = null, int $idPizza = null) {
            if (!is_null($idMEA)) {
                $this->idMEA = $idMEA;
                $this->idPizza = $idPizza;
            }
        }
    }
?>