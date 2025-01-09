<?php
require_once("Objet.php");
require_once("Produit.php");
class Commande extends Objet
{
    protected ?int $IDCommande;
    protected ?DateTime $DateCommande;
    protected ?array $Produits = [];
    protected ?string $Login;
    protected static string $classe = "Commande";
    protected string $identifiant = "IDCommande";

    public function __construct(int $IDCommande = null, DateTime $DateCommande = null, string $Login = null, ?array $Produits = null)
    {
        if (!is_null($IDCommande)) {
            $this->IDCommande = $IDCommande;
            $this->DateCommande = $DateCommande;
            $this->Login = $Login;
            if ($Produits !== null) {
                $this->Produits = $Produits;
            } 
        }
    }
    public function __toString(): string {
        return $this->IDCommande . " - " . $this->Login . " ( " . date_format($this->DateCommande, "Y-m-d h:i:s") . " ) : " . implode(", " , $this->Produits);
    }
    public function add(int $id) {

        // recupère le produit a partir de l'identitifiant 
        $req = "SELECT Produit.* FROM Produit WHERE IDProduit = :id_tag; ";

        $res = connexion::pdo()->prepare($req);

        $tags = ["id_tag" => $id];

        $res->setFetchMode(PDO::FETCH_CLASS, "Produit");
        try {

            $res->execute($tags);

            array_push($this->Produits, $res->fetch());

        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
    public function prixTotal():float {
        $prixTotal = 0.00;
        foreach ( $this->Produits as $id ) {
            $prixTotal += $id->get("PrixProduit");
        }

        return $prixTotal;
    }

    public function insertProduits() {
        $req = "INSERT INTO LigneCommande VALUES (:id_produit, $this->IDCommande, 1); " ;

        $res = connexion::pdo()->prepare($req);

        foreach ( $this->Produits as $prod ) {
            
            $tags = ["id_produit"=> $prod->get("IDProduit")] ;

            try {
            $res->execute($tags);

            // L'erreur possible : ligne déja existante donc on incrémente la quantité du produit
            } catch (PDOException $e) {
                $id = $prod->get("IDProduit");
                $update = "UPDATE LigneCommande SET quantite = quantite +1 WHERE idProduit = $id and idCommande = $this->IDCommande; " ;
            }
        }
    }
    // recréation de la fonction static getAll pour éviter l'erreur d'ajout de la variable DateCommande pour 'PDO::FETCH_CLASS', ON prend toutes les commandes qui ne sont pas encore livré ou annulé
    public static function getAll1(string $Pizzeria)
{
    $Pizzeria = doubler_apostrophe($Pizzeria);
    $requete = "SELECT Commande.* FROM Commande JOIN Statut ON Commande.IDStatut = Statut.IDStatut JOIN Pizzeria ON Pizzeria.IDPizzeria = Commande.IDPizzeria WHERE TypeStatut != 'Livré' AND TypeStatut != 'Annulé' AND NomPizzeria = '$Pizzeria';";

    $resultat = connexion::pdo()->query($requete);

    // Récupération des résultats sous forme de tableau associatif
    $donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);

    // Tableau pour stocker les instances de la classe
    $instances = [];

    // Convertir les données en instances de la classe
    foreach ($donnees as $donneesObjet) {
        $instance = new Commande();

        // Ajustez les noms des propriétés en fonction de votre classe
        foreach ($donneesObjet as $nomPropriete => $valeur) {
            if ($nomPropriete === 'DateCommande' && !empty($valeur)) {
                $instance->set("DateCommande", new DateTime($valeur));
            } else {
                $instance->$nomPropriete = $valeur;
            }
        }

        $instance->getProduits();
        // Ajouter l'instance au tableau
        $instances[] = $instance;
    }

    return $instances;
}
public function getProduits() {
    $requete = "SELECT Produit.*, quantite FROM LigneCommande JOIN Produit ON Produit.IDProduit = LigneCommande.IDProduit WHERE IDCommande = :id_tag ;" ;

    $resultat = connexion::pdo()->prepare($requete);

    $tags = ["id_tag" => $this->IDCommande];

    $resultat->execute($tags);

    $this->Produits = $resultat->fetchAll(PDO::FETCH_CLASS,"Produit");
}

}

function doubler_apostrophe($chaine)
{
    $nouvelle_chaine = '';

    for ($i = 0; $i < strlen($chaine); $i++) {
        if ($chaine[$i] == "'") {
            $nouvelle_chaine .= "''";
        } else {
            $nouvelle_chaine .= $chaine[$i];
        }
    }

    return $nouvelle_chaine;
}
?>