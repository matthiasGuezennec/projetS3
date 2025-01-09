<?php
require_once("Objet.php");

// une Pizza n'est pas forcément une pizza (oui j'ai oublié avant de tout faire)
class produit extends Objet
{
    protected ?int $IDProduit;
    protected ?string $NomProduit;
    protected ?float $PrixProduit;
    protected array $allergenes;
    protected static string $classe = "Produit";
    protected static string $identifiant = "IDProduit";

    public function __construct(int $IDProduit = null, string $nomProduit = null, float $prixProduit = null)
    {
        if (!is_null($IDProduit)) {
            $this->IDProduit = $IDProduit;
            $this->NomProduit = $nomProduit;
            $this->prixProduit = $prixProduit;
        }
    }
    public function __toString(): string
    {
        return $this->NomProduit;
    }
    public static function getIngre(int $id)
    {
        try {
            $req = "SELECT Ingredient.* FROM Produit JOIN ComposeProduit 
            ON Produit.IDProduit = ComposeProduit.IDProduit  join Ingredient on Ingredient.IDIngredient = ComposeProduit.IDIngredient WHERE Produit.IDProduit = :id_tag;";

            $res = connexion::pdo()->prepare($req);

            $tags = array("id_tag" => $id);

            $res->execute($tags);

            $res->setFetchmode(PDO::FETCH_CLASS, "Ingredient");

            $element = $res->fetchAll();

            return $element;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function getAllergenes(): void
    {
        $req = "SELECT NomAllergene FROM VueAllergene WHERE IDProduit = :id_tag;";

        $res = connexion::pdo()->prepare($req);

        $tags = ["id_tag" => $this->IDProduit];
        try {
            $res->execute($tags);

            $this->allergenes = $res->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function displayAllergene()
    {
        if (isset($this->allergenes)) {
            if (count($this->allergenes) > 0) {
            echo "<br><br><br><strong>⚠️ Ce produit contient les allergènes suivants : " . implode(", ", $this->allergenes[0]) . "⚠️</strong>";
            }
        }
    }

    // Recup des Produit en fonction du type ex : Grandes Pizzas, Boissons... (en plus de cela, les pizzas modifiés ne sont pas dans ces vues)
    public static function getGrandePizzas()
    {
        $classeRecup = static::$classe;
        $requete = "select * from VueGrandePizza; ";

        // envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);

        // traitement de la réponse par le prisme de la classe bd
        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
    public static function getMoyennePizzas()
    {
        $classeRecup = static::$classe;
        $requete = "select * from VueMoyennePizza; ";

        // envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);

        // traitement de la réponse par le prisme de la classe bd
        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
    public static function getPetitePizzas()
    {
        $classeRecup = static::$classe;
        $requete = "select * from VuePetitePizza; ";

        // envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);

        // traitement de la réponse par le prisme de la classe bd
        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
    public static function getBoissons()
    {
        $classeRecup = static::$classe;
        $requete = "select * from VueBoissons; ";

        // envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);

        // traitement de la réponse par le prisme de la classe bd
        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
    public static function getDesserts()
    {
        $classeRecup = static::$classe;
        $requete = "select * from VueDesserts; ";

        // envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);

        // traitement de la réponse par le prisme de la classe bd
        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
}
?>