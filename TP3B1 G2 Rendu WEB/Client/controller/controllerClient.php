<?php
require_once("controllerObjet.php");

class controllerClient extends controllerObjet
{
    protected static string $classe = "Client";
    protected static string $identifiant = "login";


    // vérifie si le login et le mot de passe donné est définis a un compte.
    public static function testConnexion(string $id, string $mdp): bool
    {
        $req = "SELECT * FROM Client WHERE login = :id_tag AND MDPClient = :mdp";

        $res = connexion::pdo()->prepare($req);

        $tags = array("id_tag" => $id, "mdp" => $mdp);

        try {
            $res->execute($tags);

            $nombreDeLignes = $res->rowCount();

            if ($nombreDeLignes === 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public static function update($id, $lesVals)
    {
        $req = "UPDATE Client set NomClient =:nom , PrenomClient = :prenom , Adresse = :adresse , Email = :email , Telephone = :telephone where Login = :id_tag ";

        $res = connexion::pdo()->prepare($req);

        $tags = ["id_tag" => $id, "nom" => $lesVals->get("NomClient"), "prenom" => $lesVals->get("PrenomClient"), "adresse" => $lesVals->get("Adresse"), 
        "email" => $lesVals->get("Email"), "telephone" => $lesVals->get("Telephone")];

        try {
            $res->execute($tags);
        } catch (PDOException $e) {
            echo "Une éreur lors de la mise a jour du client : " . $e->getMessage();
        }
    }


}
?>