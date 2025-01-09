<?php
 abstract class controllerObjet
{
    /*
    public static function displayAll()
    {
        $val = static::$classe;
        $title = "les $val";

        include("view/debut.php");
        include("view/menu.html");

        $tableau = static::$classe::getAll();

        include("view/list.php");
        include("view/fin.php");
    }
    */
    public static function getOne($id)
    {
        $classe = static::$classe;
        $identifiant = static::$identifiant;

        $req = "SELECT * FROM $classe where $identifiant = :id_tag;";

        $res = connexion::pdo()->prepare($req);

        $tags = array("id_tag" => $id);

        try {
            $res->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classe); // Utiliser la constante et la classe directement

            $res->execute($tags);

            $element = $res->fetch();

            return $element;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>