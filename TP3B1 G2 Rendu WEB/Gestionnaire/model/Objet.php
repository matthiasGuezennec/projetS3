<?php
abstract class Objet
{
    public function get($attribut)
    {
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void
    {
        $this->$attribut = $valeur;
    }
    public static function getAll()
    {
        $classeRecup = static::$classe;
        $requete = "select * from $classeRecup;";

        $resultat = connexion::pdo()->query($requete);

        $resultat->setFetchmode(PDO::FETCH_CLASS, $classeRecup);

        $tableau = $resultat->fetchAll();
        // on retourne le tableau d'instance
        return $tableau;
    }

    public static function getOne($attribut) {
        $classe = static::$classe;
        $identifiant = static::$identifiant;

        $req = "SELECT * FROM $classe WHERE $identifiant = :id_tag;" ;

        $res = connexion::pdo()->prepare($req);

        $tags = array("id_tag" => $attribut);

        try {
            $res->execute($tags);

            $res->setFetchMode(PDO::FETCH_CLASS, $classe);

            $element = $res->fetch();

            return $element;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>