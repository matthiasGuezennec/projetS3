<?php
include("config.php");
class connexion {
	// l'attribut static qui matérialisera la connexion
  static private $pdo;

	// le getter public de cet attribut
  static public function pdo() {
    return self::$pdo;
  }

	// la fonction static de connexion qui initialise $pdo et lance la tentative de connexion
  // PDO = PHP Data Object = une classe native adaptée à la connexion
  static public function connect()  {
    try {
    	self::$pdo = new PDO(
				"mysql:host=".HOSTNAME.";dbname=".DATABASE, LOGIN, PASSWORD,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
			);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    	echo "erreur de connexion : ".$e->getMessage()."<br>";
    }
  }
  // Créer une session si il n'y en a pas
  static public function SESSION() :void {
    
    if (session_status() == PHP_SESSION_NONE) {
      session_start([
        'cookie_secure' => true,
        'cookie_httponly' => true,
        'use_strict_mode' => true,
      ]);
    }
  }
}
?>
