<?php
require_once("Objet.php");
class Ingredient extends Objet
{
    protected ?int $IDIngredient;
    protected ?string $NomIngredient;
    protected ?int $quantite;
    protected static string $classe = "Ingredient";
    protected static string $identifiant = "IDIngredient";

    public function __construct(int $IDIngredient = null, string $NomIngredient = null, int $quantite = null)
    {
        if (isset($IDIngredient)) {
            $this->IDIngredient = $IDIngredient;
            $this->NomIngredient = $NomIngredient;
            $this->quantite = $quantite;
        }
    }
    public function __toString(): string
    {
        return $this->IDIngredient . " - " . $this->NomIngredient . " : " . $this->quantite;
    }

    // second toString pour un contexte différent (ne peux donc pas etre utilisé normalement)
    public function toString() {
        return $this->IDIngredient . " - " . $this->NomIngredient;
    }
    // récupère tous les ingrédients et les quantité en stock de la pizzeria
    public function getStock($id)
    {
        $req = "SELECT Ingredient.IDIngredient, NomIngredient, quantite FROM STOCK JOIN Ingredient ON Ingredient.IDIngredient = Stock.IDIngredient WHERE IDPizzeria = :id_tag ;";

        $res = connexion::pdo()->prepare($req);

        $tags = ["id_tag" => $id];

        try {
            $res->execute($tags);

            $res->setFetchMode(PDO::FETCH_CLASS, "Ingredient");

            return $res->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // recupère les stock de tous les ingrédients de la pizzeria
    public static function getAll1($id)
    {
        $id = self::doubleSingleQuotes($id);
        $req = "SELECT Ingredient.IDIngredient, NomIngredient, quantite FROM Ingredient JOIN Stock ON Stock.IDIngredient = Ingredient.IDIngredient JOIN Pizzeria ON Pizzeria.IDPizzeria = Stock.IDPizzeria WHERE NomPizzeria = " . doubler_apostrophe1($id) . ";";

        $res = connexion::pdo()->query($req);

        return $res->fetchAll(PDO::FETCH_CLASS, "Ingredient");
    }

    // ajoute du stock pour tous les Ingredients pour une pizzeria
    public static function addStock(int $nb, string $Pizzeria)
    {
        $req = "UPDATE Stock JOIN Pizzeria ON Pizzeria.IDPizzeria = Stock.IDPizzeria SET Stock.quantite = Stock.quantite + :nb WHERE NomPizzeria = '" . self::doubleSingleQuotes($Pizzeria) . "'  ; ";

        $res = connexion::PDO()->prepare($req);

        $tags = ["nb" => $nb];

        try {
            $res->execute($tags);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function doubleSingleQuotes(string $str)
    {
        return str_replace("'", "''", $str);
    }

    public static function insertNew(string $nom)
    {
        $req = "INSERT INTO Ingredient VALUES (NULL, '" . self::doubleSingleQuotes($nom) . "' );";

        $res = connexion::pdo()->prepare($req);

                            // ajoute un apostrohe devant les appostrophe pour evité les erreur dans le cas ou le nom en aurai un et entour le nom pour les possibles espaces
        try {
            $res->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
// permet de retirer les erreur de ' dans les requetes sql pour les nom de pizzeria 
function doubler_apostrophe1(string $chaine)
{
    return "'" . $chaine . "'";
}
?>