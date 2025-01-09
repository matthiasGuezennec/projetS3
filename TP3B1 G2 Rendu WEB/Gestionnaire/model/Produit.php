<?php
require_once("Objet.php");

// une Pizza n'est pas forcément une pizza (oui j'ai oublié avant de tout faire)
class produit extends Objet
{
    protected ?int $IDProduit;
    protected ?string $NomProduit;
    protected ?float $PrixProduit;
    protected array $allergenes;
    protected ?int $quantite;
    protected static string $classe = "Produit";
    protected static string $identifiant = "IDProduit";

    public function __construct(int $IDProduit = null, string $nomProduit = null, float $prixProduit = null, int $quantite = null)
    {
        if (!is_null($IDProduit)) {
            $this->IDProduit = $IDProduit;
            $this->NomProduit = $nomProduit;
            $this->prixProduit = $prixProduit;
            $this->quantite = $quantite;
        }
    }
    public function __toString(): string
    {
        return $this->quantite . " : " . $this->NomProduit;
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

        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
    public static function getMoyennePizzas()
    {
        $classeRecup = static::$classe;
        $requete = "select * from VueMoyennePizza; ";

        $resultat = connexion::pdo()->query($requete);

        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
    public static function getPetitePizzas()
    {
        $classeRecup = static::$classe;
        $requete = "select * from VuePetitePizza; ";

        $resultat = connexion::pdo()->query($requete);

        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
    public static function getBoissons()
    {
        $classeRecup = static::$classe;
        $requete = "select * from VueBoissons; ";

        $resultat = connexion::pdo()->query($requete);

        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
    public static function getDesserts()
    {
        $classeRecup = static::$classe;
        $requete = "select * from VueDesserts; ";

        $resultat = connexion::pdo()->query($requete);

        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        // on retourne le tableau d'instance
        return $resultat->fetchAll();
    }
    public static function getAll_forMEA()
    {
        $requete = "SELECT * FROM Produit WHERE IDProduit NOT IN (SELECT IDProduit FROM VueMEA);";

        $resultat = connexion::pdo()->query($requete);

        $resultat->setFetchmode(PDO::FETCH_CLASS, "Produit");

        $tableau = $resultat->fetchAll();
        // on retourne le tableau d'instance
        return $tableau;
    }
    public static function getAll_NB_1SEM() {
        // recupère la somme des produits sur les 7 derniers jours
        $requete = "SELECT Produit.IDProduit, nomProduit, prixProduit, SUM(quantite) FROM Produit JOIN LigneCommande ON LigneCommande.IDProduit = Produit.IDproduit JOIN Commande ON Commande.IDCommande = LigneCommande.IDCommande WHERE DATEDIFF(NOW(), Commande.DateCommande) <= 7 GROUP BY(Produit.IDProduit) ;" ;

        try {
        $resultat = connexion::pdo()->query($requete);

        return $resultat->fetchAll();

        }catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
    public static function getAll_NB_1MONTH() {
        // recupère la somme des produits sur le mois
        $requete = "SELECT Produit.IDProduit, nomProduit, prixProduit, SUM(quantite) FROM Produit JOIN LigneCommande ON LigneCommande.IDProduit = Produit.IDproduit JOIN Commande ON Commande.IDCommande = LigneCommande.IDCommande WHERE TIMESTAMPDIFF(MONTH, NOW(), Commande.DateCommande) < 1 GROUP BY(Produit.IDProduit) ;" ;

        try {
        $resultat = connexion::pdo()->query($requete);

        return $resultat->fetchAll();

        }catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
    public static function Total_1SEM() {
        $requete = "SELECT SUM(prixProduit * quantite) FROM Produit JOIN LigneCommande ON LigneCommande.IDProduit = Produit.IDproduit JOIN Commande ON Commande.IDCommande = LigneCommande.IDCommande WHERE DATEDIFF(NOW(), Commande.DateCommande) <= 7 ;" ;

        try {
        $resultat = connexion::pdo()->query($requete);

        return $resultat->fetchAll();

        }catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
    public static function Total_1MONTH() {
        $requete = "SELECT SUM(prixProduit * quantite) FROM Produit JOIN LigneCommande ON LigneCommande.IDProduit = Produit.IDproduit JOIN Commande ON Commande.IDCommande = LigneCommande.IDCommande WHERE TIMESTAMPDIFF(MONTH, NOW(), Commande.DateCommande) < 1 ;" ;

        try {
        $resultat = connexion::pdo()->query($requete);

        return $resultat->fetchAll();

        }catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
?>