<!DOCTYPE html>
<html lang="fr">

<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="css/style.css">

        <title>Créer votre compte</title>
        <style>
                body {
                        font-family: 'Arial', sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                }

                h2 {
                        text-align: center;
                        color: #333;
                }

                form {
                        max-width: 400px;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #fff;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        border-radius: 8px;
                }

                label {
                        display: block;
                        margin-bottom: 8px;
                        color: #555;
                }

                input[type="text"],
                input[type="password"],
                input[type="tel"],
                input[type="email"] {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 15px;
                        box-sizing: border-box;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                }

                input[type="submit"] {
                        background-color: #4caf50;
                        color: white;
                        padding: 12px 20px;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 16px;
                        transition: background-color 0.3s;
                }

                input[type="submit"]:hover {
                        background-color: #45a049;
                }
        </style>
</head>

<body>
        <?php
        require_once("config/connexion.php");
        require_once("model/Client.php");

        connexion::SESSION();
        connexion::connect();
        include("view/header.php");
        include("view/AccueilDebut.html");
        include("view/formulaireCreaCompte.html");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $login = $_POST['login'];
                $password = $_POST['password'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $adresse = $_POST['adresse'];
                $telephone = $_POST['telephone'];
                $email = $_POST['email'];


                $res = Client::insert($login, $password, $nom, $prenom, $adresse, $telephone, $email);

                if ($res) {
                        header('location: accueil.php');
                        exit();
                } else {
                        echo "<div style='color: red; text-align: center;'>Valeurs entrées incorrectes</div>";
                }
        }
        ?>
</body>