<?php
require_once("Objet.php");
class Promotion extends Objet
{
    protected ?int $IDPromotion;
    protected ?string $DateDebPromotion;
    protected ?string $DateFinPromotion;
    protected ?array $NomTypePromotion;
    public function __construct(int $IDPromotion = null, string $NomPromotion = null, string $DateDebPromotion = null, string $DateFinPromotion = null, array $NomTypePromotion = null)
    {
        if (!is_null($IDPromotion)) {
            $this->IDPromotion = $IDPromotion;
            $this->NomPromotion = $NomPromotion;
            $this->DateDebPromotion = $DateDebPromotion;
            $this->DateFinPromotion = $DateFinPromotion;
            $this->NomTypePromotion = $NomTypePromotion;
        }
    }
    // afichage de la promotion ex : 
    public function __toString(): string
    {
        return $this->DateDebPromotion . " - " . $this->DateFinPromotion . " => ( " . implode(",", $this->NomTypePromotion[0]) . " )";
    }

    public function getTypePromotion()
    {
        $req = "SELECT NomTypeProduit FROM Promo_TypeProduit JOIN TypeProduit ON TypeProduit.IDTypeProduit = Promo_TypeProduit.IDTypeProduit WHERE IDPromotion = :id_tag;";

        $res = connexion::pdo()->prepare($req);

        $tags = ["id_tag" => $this->IDPromotion];

        try {

            $res->execute($tags);

            $this->NomTypePromotion = $res->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "" . $e->getMessage() . "";
        }
    }
    public static function getAll()
    {
        $req = "SELECT Promotion.IDPromotion, DateDebPromotion, DateFinPromotion FROM Promotion WHERE DATEDIFF(NOW(), DateFinPromotion) < 0 ";

        try {

            $res = connexion::pdo()->prepare($req);

            $res->execute();

            $res->setFetchMode(PDO::FETCH_CLASS, "Promotion");

            return $res->fetchAll();

        } catch (PDOException $e) {

            echo "" . $e->getMessage() . "";
        }
    }
    public static function addPromo(DateTime $dateDeb, DateTime $dateFin, array $promo, int $reduc)
    {
        $req = "INSERT INTO Promotion VALUES (NULL, :dateDeb , :dateFin , :reduction ) ; ";

        $res = connexion::pdo()->prepare($req);

        $tags = ["dateDeb" => $dateDeb, "dateFin" => $dateFin, "reduction" => $reduc];

        try {
            $res->execute($tags);

            $id = self::getIDPromotion($dateDeb, $dateFin, $reduc);

            $req = "INSERT INTO Promo_TypeProduit VALUES ($id, :promo)";

            foreach ($promo as $promoItem) {
                $tags = ["promo"=> $promoItem];

                $res = connexion::pdo()->prepare($req);
                
                $res->execute($tags);
            }
        } catch (PDOException $e) {
            echo "" . $e->getMessage() . "";
        }
    }

    public static function getIDPromotion(DateTime $dateDeb, DateTime $dateFin, int $reduc)
    {
        $req = "SELECT IDPromotion FROM Promotion WHERE DateDebPromotion = :dateDeb , DateFinPromotion = :dateFin , PourcentagePromotion = :reduction ; ";

        $res = connexion::pdo()->prepare($req);

        $tags = ["dateDeb" => $dateDeb, "dateFin" => $dateFin, "reduction" => $reduc];

        try {
            $res->execute($tags);

            return $res->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "" . $e->getMessage() . "";

        }
    }
}
?>