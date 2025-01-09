<?php
require_once("model/MiseEnAvant.php");
class controllerMiseEnAvant
{
    public static function getOne($id)
{
    $identifiant = "IDMea";

    $req = "SELECT IDProduit, NomProduit, PrixProduit FROM VueMEA WHERE $identifiant = :id_tag;";

    $res = connexion::pdo()->prepare($req);

    $tags = array("id_tag" => $id);

    try {
        $res->execute($tags);

        $res->setFetchmode(PDO::FETCH_CLASS, "Produit");

        $element = $res->fetch();

        return $element;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

public static function getLine() {
    try {
        $req = "SELECT COUNT(*) FROM VueMEA;";

        $res = connexion::pdo()->query($req);
        return $res->fetchColumn();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

public static function del (int $id ) {
    $req = "DELETE FROM MiseEnAvant WHERE IDProduit = :id_tag ;" ;

    $res = connexion::pdo()->prepare($req);

    $tags = ["id_tag" => $id];

    try {

        if (self::getLine() > 8)
            $res->execute($tags);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
public static function getAll () {
    $req = "SELECT * FROM VueMEA";

    $res = connexion::pdo()->prepare($req);

    $res ->execute();

    return $res -> fetchAll();
}
public static function add(int $id) {
    $req = "INSERT INTO MiseEnAvant VALUES (NULL, :id_tag) ;" ;

    $res = connexion::pdo()->prepare($req);

    $tags = ["id_tag" => $id];
    try {
        $res->execute($tags);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
public static function getMEA()
    {
        $req = "SELECT IDProduit, NomProduit, PrixProduit FROM VueMEA ORDER BY IDMEA DESC LIMIT 4; ";

        try {
            $res = connexion::pdo()->query($req);

            $res->setFetchMode(PDO::FETCH_CLASS, "Produit");

            return $res->fetchAll();
            
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
?>