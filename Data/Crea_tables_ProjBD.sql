-- Tables Taille, Stock, PAS DE LIGNEMEA
CREATE TABLE Statut (
    IDStatut INT PRIMARY KEY AUTO_INCREMENT,
    TypeStatut VARCHAR(20) NOT NULL
);

CREATE TABLE Pizzeria (
    IDPizzeria INT PRIMARY KEY AUTO_INCREMENT,
    NomPizzeria VARCHAR(30),
    AdressePizzeria VARCHAR(50)
);

CREATE TABLE Livreur (
    IDLivreur INT PRIMARY KEY AUTO_INCREMENT,
    NomLivreur VARCHAR(30),
    PrenomLivreur VARCHAR(30),
    MailLivreur VARCHAR(80) UNIQUE,
    MDPLivreur VARCHAR(100) NOT NULL
);

CREATE TABLE Client(
   Login VARCHAR(16) PRIMARY KEY,
   MDPClient VARCHAR(100) NOT NULL,
   Telephone VARCHAR(14) UNIQUE NOT NULL,
   Email VARCHAR(20) UNIQUE NOT NULL,
   NomClient VARCHAR(20) NOT NULL,
   PrenomClient VARCHAR(20) NOT NULL,
   Adresse VARCHAR(50) NOT NULL,
   ReductionClient TINYINT(1) NOT NULL
);

CREATE TABLE Produit(
   IDProduit INT PRIMARY KEY AUTO_INCREMENT,
   NomProduit VARCHAR(20) NOT NULL,
   PrixProduit float NOT NULL
);

CREATE TABLE Ingredient(
   IDIngredient INT PRIMARY KEY AUTO_INCREMENT,
   NomIngredient VARCHAR(20) NOT NULL
);

CREATE TABLE Promotion(
   IDPromotion INT PRIMARY KEY AUTO_INCREMENT,
   DateFInPromotion DATE NOT NULL,
   DateDebPromotion DATE NOT NULL,
   PourcentagePromotion INT NOT NULL
);

CREATE TABLE Allergene(
   IDAllergene INT PRIMARY KEY AUTO_INCREMENT,
   NomAllergene VARCHAR(50) NOT NULL
);

CREATE TABLE MiseEnAvant(
   IDMea INT PRIMARY KEY AUTO_INCREMENT,
   IDProduit INT NOT NULL,
   FOREIGN KEY(IDProduit) REFERENCES Produit(IDProduit)
);

CREATE TABLE TypeProduit(
   IDTypeProduit INT PRIMARY KEY AUTO_INCREMENT,
   NomTypeProduit VARCHAR(50) NOT NULL
);

CREATE TABLE Commande(
   IDCommande INT PRIMARY KEY AUTO_INCREMENT,
   DateCommande DATETIME NOT NULL,
   TotalCommande float,
   IDPizzeria INT NOT NULL,
   IDLivreur INT,
   IDStatut INT NOT NULL,
   Login VARCHAR(16) NOT NULL,
   FOREIGN KEY(IDPizzeria) REFERENCES Pizzeria(IDPizzeria),
   FOREIGN KEY(IDLivreur) REFERENCES Livreur(IDLivreur),
   FOREIGN KEY(IDStatut) REFERENCES Statut(IDStatut),
   FOREIGN KEY(Login) REFERENCES Client(Login)
);

CREATE TABLE LigneCommande(
   IDProduit INT,
   IDCommande INT,
   quantite INT NOT NULL,
   PRIMARY KEY(IDProduit, IDCommande),
   FOREIGN KEY(IDProduit) REFERENCES Produit(IDProduit),
   FOREIGN KEY(IDCommande) REFERENCES Commande(IDCommande)
);

CREATE TABLE ComposeProduit(
   IDProduit INT,
   IDIngredient INT,
   quantite INT,
   PRIMARY KEY(IDProduit, IDIngredient),
   FOREIGN KEY(IDProduit) REFERENCES Produit(IDProduit),
   FOREIGN KEY(IDIngredient) REFERENCES Ingredient(IDIngredient)
);

CREATE TABLE ContientAllergene(
   IDIngredient INT,
   IDAllergene INT,
   PRIMARY KEY(IDIngredient, IdAllergene),
   FOREIGN KEY(IDIngredient) REFERENCES Ingredient(IDIngredient),
   FOREIGN KEY(IdAllergene) REFERENCES Allergene(IdAllergene)
);

CREATE TABLE Stock(
   IDIngredient INT,
   IDPizzeria INT,
   quantite INT,
   PRIMARY KEY(IDIngredient, IDPizzeria),
   FOREIGN KEY(IDIngredient) REFERENCES Ingredient(IDIngredient),
   FOREIGN KEY(IDPizzeria) REFERENCES Pizzeria(IDPizzeria)
);

CREATE TABLE est_Produit_de(
   IDProduit INT,
   IDTypeProduit INT,
   PRIMARY KEY(IDProduit, IDTypeProduit),
   FOREIGN KEY(IDProduit) REFERENCES Produit(IDProduit),
   FOREIGN KEY(IDTypeProduit) REFERENCES TypeProduit(IDTypeProduit)
);

CREATE TABLE Promo_TypeProduit(
   IDPromotion INT,
   IDTypeProduit INT,
   PRIMARY KEY(IDPromotion, IDTypeProduit),
   FOREIGN KEY(IDPromotion) REFERENCES Promotion(IDPromotion),
   FOREIGN KEY(IDTypeProduit) REFERENCES TypeProduit(IDTypeProduit)
);

CREATE TABLE Alerte (
   IDIngredient INT,
   IDPizzeria INT,
   DateAlerte DATE, 
   constraint cleAlerte PRIMARY KEY (IDIngredient, DateAlerte),
   constraint cleAlerte_Ingredient FOREIGN KEY (IDIngredient) REFERENCES Ingredient(IDIngredient),
   constraint cleAlerte_Pizzeria FOREIGN KEY (IDPizzeria) REFERENCES Pizzeria(IDPizzeria)
);