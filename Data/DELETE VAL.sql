-- Supprimer les relations avec les clés étrangères d'abord
DELETE FROM ContientAllergene;
DELETE FROM Promo_TypeProduit;
DELETE FROM est_Produit_de;

-- Supprimer les tables liées aux clés étrangères
DELETE FROM MiseEnAvant;
DELETE FROM Stock;

-- Supprimer les autres tables
DELETE FROM Commande;
DELETE FROM Client;
DELETE FROM Produit;
DELETE FROM Promotion;
DELETE FROM TypeProduit;
DELETE FROM Livreur;
DELETE FROM Pizzeria;
DELETE FROM Statut;
DELETE FROM Ingredient;
DELETE FROM Allergene;

-- Réinitialiser les auto-incréments
ALTER TABLE Pizzeria AUTO_INCREMENT = 1;
ALTER TABLE Statut AUTO_INCREMENT = 1;
ALTER TABLE Ingredient AUTO_INCREMENT = 1;
ALTER TABLE Allergene AUTO_INCREMENT = 1;
ALTER TABLE Produit AUTO_INCREMENT = 1;
ALTER TABLE MiseEnAvant AUTO_INCREMENT = 1;
ALTER TABLE ContientAllergene AUTO_INCREMENT = 1;
ALTER TABLE Livreur AUTO_INCREMENT = 1;
ALTER TABLE Promotion AUTO_INCREMENT = 1;
ALTER TABLE TypeProduit AUTO_INCREMENT = 1;
ALTER TABLE Promo_TypeProduit AUTO_INCREMENT = 1;
ALTER TABLE est_Produit_de AUTO_INCREMENT = 1;
ALTER TABLE Client AUTO_INCREMENT = 1;
ALTER TABLE Commande AUTO_INCREMENT = 1;
