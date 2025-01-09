<?php
require_once("Objet.php");
class Client extends Objet
{
    protected ?string $Login;
    protected ?string $MDPClient;
    protected ?string $NomClient;
    protected ?string $PrenomClient;
    protected ?string $Email;
    protected ?string $Adresse;
    protected ?string $Telephone;
    protected ?bool $ReductionClient;

    protected static string $classe = "Client";
    protected static string $identifiant = "Login";
    public function __construct(string $login = null, string $MDPClient = null, string $nomClient = null, string $prenomClient = null, string $email = null, string $adresse = null, string $telephone = null, bool $reduc = null)
    {
        if (!is_null($login)) {
            $this->login = $login;
            $this->MDPClient = $MDPClient;
            $this->nomClient = $nomClient;
            $this->prenomClient = $prenomClient;
            $this->email = $email;
            $this->adresse = $adresse;
            $this->telephone = $telephone;
            $this->ReductionClient = $reduc;
        }
    }

    // apres l'entré des données du compte, on envoi une requete de création pour se compte
    public static function insert($login, $password, $nom, $prenom, $adresse, $telephone, $email)
    {
        try {
            $reduc = false;

            $hashMotDePasse = password_hash($password, PASSWORD_DEFAULT);


            $req = "INSERT INTO Client VALUES (:Login, :MDPClient, :NomClient, :PrenomClient, :Telephone, :Email, :Adresse, 0)";

            // Préparation de la requête
            $stmt = connexion::pdo()->prepare($req);

            // formatage du numéro de téléphone avant de l'insérer dans la base de données
            $telephone = self::formatNumTel($telephone);
            // Liaison des paramètres
            $stmt->bindParam(':Login', $login);
            $stmt->bindParam(':MDPClient', $hashMotDePasse);
            $stmt->bindParam(':NomClient', $nom);
            $stmt->bindParam(':PrenomClient', $prenom);
            $stmt->bindParam(':Telephone', $telephone);
            $stmt->bindParam(':Email', $email);
            $stmt->bindParam(':Adresse', $adresse);

            // Exécution de la requête
            if ($stmt->execute()) {

                return true;

            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    // test si la tentative de connexion au compte est correcte
    public static function testClient($login, $motDePasse)
    {

        // on récupère le mot de passe hashé pour le login donné

        $sql = "SELECT MDPClient FROM Client WHERE Login = :login";

        $stmt = connexion::pdo()->prepare($sql);

        $stmt->bindParam(':login', $login);
        $stmt->execute();

        // on vérifie la combinaison entre le mot de passe et le login
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hashMotDePasse = $row['MDPClient'];

            // si c'est le bien le mot de passe on retourne vrai
            if (password_verify($motDePasse, $hashMotDePasse)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // Pour formatter le numéro de téléphone
    public static function formatNumTel($num)
    {
        // laisse que les valeur numériques
        $num = preg_replace("/[^0-9]/", "", $num);

        // verifie la longueur
        if (strlen($num) !== 10) {
            return null;
        }
        // retourne le numéro formatté
        return $val = substr($num, 0, 2) . "." . substr($num, 2, 2) . "." . substr($num, 4, 2) . "." . substr($num, 6, 2) . "." . substr($num, 8, 2);
    }
    public static function addCommande($numCarte, $dateExp, $CVV) {

        // Hashage des mot de passe
        $numCarte = password_hash($numCarte, PASSWORD_DEFAULT);
        $dateExp = password_hash($dateExp, PASSWORD_DEFAULT);
        $CVV = password_hash($CVV, PASSWORD_DEFAULT);

        $req = "INSERT INTO CarteBanquaire VALUES (:numCarte, :dateExp, :Cvv)";

        $res = connexion::pdo()->prepare($req);

        $tag = ["numCarte" => $numCarte, "dateExp" => $dateExp, "Cvv" => $CVV];
        try {

            $res->execute($tag);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>