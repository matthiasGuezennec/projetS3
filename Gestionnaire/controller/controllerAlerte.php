<?php
require_once("controllerObjet.php");
class ControllerAlerte extends ControllerObjet
{
    protected static string $classe = "Alerte";
    protected static string $identifiant = "IDAlerte";

    public static function getAll(string $pizzeria)
    {
        $req = "SELECT IDAlerte, NomIngredient, DateAlerte FROM Alerte JOIN Pizzeria ON Pizzeria.IDPizzeria = Alerte.IDPizzeria JOIN Ingredient ON Ingredient.IDIngredient = Alerte.IDIngredient WHERE NomPizzeria = '" . $pizzeria . "' ORDER BY IDAlerte DESC;";

        try {
            $res = connexion::pdo()->query($req);

            $donnees = $res->fetchAll(PDO::FETCH_ASSOC);

            // Tableau pour stocker les instances de la classe
            $instances = [];

            // Convertir les données en instances de la classe
            foreach ($donnees as $donneesObjet) {
                $instance = new Alerte();

                // Ajustez les noms des propriétés en fonction de votre classe
                foreach ($donneesObjet as $nomPropriete => $valeur) {
                    if ($nomPropriete === 'DateAlerte' && !empty($valeur)) {
                        $instance->set("DateAlerte", new DateTime($valeur));
                    } else {
                        $instance->set("$nomPropriete", $valeur);
                    }
                }
                // Ajouter l'instance au tableau
                $instances[] = $instance;
            }

            return $instances;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>