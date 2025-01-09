<?php
require_once("Objet.php");
class Commande extends Objet
{
    protected ?int $IDCommande;
    protected ?DateTime $DateCommande;
    protected ?array $Produits = [];
    protected static string $classe = "Commande";
    protected string $identifiant = "IDCommande";

    public function __construct(int $IDCommande = null, DateTime $DateCommande = null, ?array $Produits = null)
    {
        if (!is_null($IDCommande)) {
            $this->IDCommande = $IDCommande;
            $this->DateCommande = $DateCommande;
            if ($Produits !== null) {
                $this->Produits = $Produits;
            }
        }
    }
    public function add(int $id)
    {

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
    public function del(int $id)
    {
        array_splice($this->Produits, $id, 1);
    }
    public function prixTotal(): float
    {
        $prixTotal = 0.00;
        foreach ($this->Produits as $id) {
            $prixTotal += $id->get("PrixProduit");
        }

        return $prixTotal;
    }

    public function insertProduits(string $login)
    {

        $this->IDCommande = $this->getID();

        $req = "INSERT INTO LigneCommande VALUES (:id_produit, :idCommande, 1); ";

        $res = connexion::pdo()->prepare($req);

        foreach ($this->Produits as $prod) {

            $tags = ["id_produit" => $prod->get("IDProduit"), "idCommande" => $this->IDCommande];

            try {
                $res->execute($tags);

                // L'erreur possible : ligne déja existante donc on incrémente la quantité du produit
            } catch (PDOException $e) {
                $id = $prod->get("IDProduit");
                $update = "UPDATE LigneCommande SET quantite = quantite +1 WHERE idProduit = :id_produit and idCommande = :idCommande; ";

                $tags = ["id_produit" => $prod->get("IDProduit"), "idCommande" => $this->IDCommande];

                $res = connexion::pdo()->prepare($update);
                
                $res->execute($tags);
            }
        }
    }
    public function getID()
    {
        $req = "SELECT IDCommande FROM Commande;";

        $res = connexion::pdo()->prepare($req);

        try {

            $res->execute();

            return $res->rowCount();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>