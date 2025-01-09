<?php
require_once("model/Commande.php");
class controllerCommande
{
    public static function insertCommande(string $login, int $pizzeria, Commande $commande) {

        // requete insert de la commande 
        $req = "INSERT INTO Commande VALUES (NULL, NOW(), NULL, :pizzeria, NULL, 0, :login)";

        $res = connexion::pdo()->prepare($req);
        
        $res->bindParam(':pizzeria', $pizzeria);
        $res->bindParam(':login', $login);
        
        $res->execute();
        $commande->insertProduits($login);
    }

    public static function getPizzeria () {
        $req = "SELECT NomPizzeria, IDPizzeria FROM Pizzeria; " ;

        $res = connexion::pdo()->prepare($req);

        try {
            $res->execute() ;

            return $res->fetchAll();
        }
        catch (PDOException $e) {
            echo"". $e->getMessage() ."";
        }
    }
}

?>