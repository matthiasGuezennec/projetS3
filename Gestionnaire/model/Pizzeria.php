<?php
require_once("Objet.php");
class Pizzeria extends Objet
{
    protected ?int $IDPizzeria;
    protected ?string $NomPizzeria;
    protected ?string $AdressePizzeria;

    protected static string $classe = "Pizzeria";
    protected static string $identifiant = "IDPizzeria";

    public function __construct(int $IDPizzeria = null, string $NomPizzeria = null, string $AdressePizzeria = null)
    {
        if (!is_null($IDPizzeria)) {
            $this->IDPizzeria = $IDPizzeria;
            $this->NomPizzeria = $NomPizzeria;
            $this->AdressePizzeria = $AdressePizzeria;
        }
    }
    // verifie si la pizzeria en paramètre existe dans la base de données
    public static function verifNom(string $NomPizzeria)
    {
        $req = "SELECT NomPizzeria FROM Pizzeria WHERE NomPizzeria = :nom ;";

        $res = connexion::pdo()->prepare($req);

        $tags = ["nom" => $NomPizzeria];
        try {

            $res->execute($tags);

            $res->setFetchMode(PDO::FETCH_CLASS, "Pizzeria");

            return $res->fetch();
            
        } catch (PDOException $e) {
            return NULL;
        }
    }
    public static function getAll()
    {
        $requete = "SELECT NomPizzeria from Pizzeria;";

        // envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);

        $resultat->setFetchmode(PDO::FETCH_ASSOC);

        // récupération des instances
        return $resultat->fetchAll();
    }
}
?>