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


}
?>