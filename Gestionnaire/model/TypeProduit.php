<?php
require_once("Objet.php");
class TypeProduit extends Objet
{
    protected ?int $IDTypeProduit;
    protected ?string $NomTypeProduit;
    protected static string $classe = "TypeProduit";
    protected static string $identifiant = "IDTypeProduit";

    public function __construct(int $IDTypeProduit = null, string $NomTypeProduit = null)
    {
        if (!is_null($IDTypeProduit)) {
            $this->IDTypeProduit = $IDTypeProduit;
            $this->NomTypeProduit = $NomTypeProduit;
        }
    }
    public function __toString(): string
    {
        return $this->IDTypeProduit . " - " . $this->NomTypeProduit;
    }
    public static function insert(string $produit, string $type): void
    {

        $produit = preg_replace("/[^0-9]/", "", $produit);
        $type = preg_replace("/[^0-9]/", "", $type);

        $req = "INSERT INTO est_Produit_de VALUES ($produit, $type); ";

        try {

            connexion::pdo()->query($req);

        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
?>