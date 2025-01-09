
CREATE VIEW VueMoyennePizza AS
SELECT Produit.*
FROM Produit
JOIN est_Produit_de
ON est_Produit_de.IDProduit = Produit.IDProduit
JOIN TypeProduit
ON est_Produit_de.IDTypeProduit = TypeProduit.IDTypeProduit
WHERE NomTypeProduit = 'Moyenne Pizzas';

CREATE VIEW VueGrandePizza AS
SELECT Produit.*
FROM Produit
JOIN est_Produit_de
ON est_Produit_de.IDProduit = Produit.IDProduit
JOIN TypeProduit
ON est_Produit_de.IDTypeProduit = TypeProduit.IDTypeProduit
WHERE NomTypeProduit = 'Grandes Pizzas';

CREATE VIEW VuePetitePizza AS
SELECT Produit.*
FROM Produit
JOIN est_Produit_de
ON est_Produit_de.IDProduit = Produit.IDProduit
JOIN TypeProduit
ON est_Produit_de.IDTypeProduit = TypeProduit.IDTypeProduit
WHERE NomTypeProduit = 'Petite Pizzas';

CREATE VIEW VueBoissons AS
SELECT Produit.*
FROM Produit
JOIN est_Produit_de
ON est_Produit_de.IDProduit = Produit.IDProduit
JOIN TypeProduit
ON est_Produit_de.IDTypeProduit = TypeProduit.IDTypeProduit
WHERE NomTypeProduit = 'Boisson';

CREATE VIEW VueDesserts AS
SELECT Produit.*
FROM Produit
JOIN est_Produit_de
ON est_Produit_de.IDProduit = Produit.IDProduit
JOIN TypeProduit
ON est_Produit_de.IDTypeProduit = TypeProduit.IDTypeProduit
WHERE NomTypeProduit = 'Dessert';

CREATE VIEW VueMEA AS 
SELECT IDMea, Produit.IDProduit, NomProduit, PrixProduit
FROM Produit
JOIN MiseEnAvant 
ON Produit.IDProduit = MiseEnAvant.IDProduit;

CREATE VIEW VueAllergene AS
SELECT Produit.IDProduit, NomAllergene
FROM Produit
JOIN ComposeProduit
ON ComposeProduit.IDProduit = Produit.IDProduit
JOIN Ingredient
ON Ingredient.IDIngredient = ComposeProduit.IDIngredient
JOIN ContientAllergene
ON ContientAllergene.IDIngredient = Ingredient.IDIngredient
JOIN Allergene
ON Allergene.IDAllergene = ContientAllergene.IDAllergene;
