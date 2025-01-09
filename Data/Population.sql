-- fait : statut, pizzeria, ingredient, allergene, contientallergene, miseenavant, produit, promotion, groupeproduit, estdegroupe, estpromotionne, client, commande
-- pas fait encore : rien lol

INSERT INTO Pizzeria VALUES
 (NULL, 'Pizzeria d''Ananas', '23 Rue du Ham. des Joncherettes'),
 (NULL, 'Pizzeria a la Bolognaise', '15 Rue Georges Clemenceau, 91400 Orsay'),
 (NULL, 'Pizzeria de la Carpe', '609 Dom. de l''Université de Paris S, 91190 Gif-sur-Yvette'),
 (NULL, 'Pizzeria de la Dalle', '24 Rue de la Guyonnerie, 91440 Bures-sur-Yvette'),
 (NULL, 'Pizzeria Elton John', 'Rue des Templiers, 91400 Saclay'),
 (NULL, 'Pizzeria Fricaccia', '3 Rue Eginhard, 75004 Paris'),
 (NULL, 'Pizzeria Gourmande', '166 Rue de Rivoli, 75001 Paris'),
 (NULL, 'Pizzeria Hadriana', 'Bd des Invalides, 75007 Paris'),
 (NULL, 'Pizzeria Iberico', 'Champ de Mars, 5 Av. Anatole France, 75007 Paris'),
 (NULL, 'Pizzeria chez Jojo', '5 Rue Soufflot, 75005 Paris'),
 (NULL, 'Pizzeria Kilimandjaro', '317 Rue du Faubourg Saint-Antoine, 75011 Paris'),
 (NULL, 'Pizzeria Lananas c bon', '28 Rue Darwin, 94800 Villejuif'),
 (NULL, 'Pizzeria Mahi mahi', '67 bis Av. Albert Petit, 92220 Bagneux'),
 (NULL, 'Pizzeria Nicolò', '156 Av. des Champs-Élysées, 75008 Paris'),
 (NULL, 'Pizzeria lOriginal', '1 place Monge, 91600 Savigny-sur-Orge');


INSERT INTO Statut VALUES
 (NULL, 'En Cuisine'),
 (NULL, 'En Livraison'), 
 (NULL, 'Livré'),
 (NULL, 'Annulé');


INSERT INTO Ingredient VALUES
(NULL, 'Ananas'),
(NULL, 'Banane'),
(NULL, 'Camembert'),
(NULL, 'jambon de Dinde'),
(NULL, 'Epinards'), 
(NULL, 'Fromage blanc'), 
(NULL, 'Gesier'), 
(NULL, 'Habanero'), 
(NULL, 'Iberico'), 
(NULL, 'Jambonneau'), 
(NULL, 'Kilo de sauce tomate'),
(NULL, 'Lait'),
(NULL, 'M&Ms'), 
(NULL, 'Noix'),
(NULL, 'Oeuf' );


INSERT INTO Allergene VALUES
(NULL, 'Oeuf'),
(NULL, 'Lait'),
(NULL, 'Moutarde'),
(NULL, 'Arachide'),
(NULL, 'Mollusques et crustacés'),
(NULL, 'Poissons'),
(NULL, 'Graines de sésame'),
(NULL, 'Soja'),
(NULL, 'Sulfites'),
(NULL, 'Noix'),
(NULL, 'Blé et triticale'),
(NULL, 'Touriste Norvegien');


INSERT INTO Produit VALUES
(NULL, 'produit_dynamique_1', 10.00),
(NULL, 'produit_dynamique_2', 3.0),
(NULL, 'Au Camembert', 15.00),
(NULL, '4 fromages', 12.00),
(NULL, 'chocolat', 14.00), 
(NULL, 'pepperoni', 15.00),
(NULL, 'produit_dynamique_3', 5.50),
(NULL, 'flan', 6),
(NULL, 'salade', 9),
(NULL, 'glace vanille', 4.40),
(NULL, 'Jambon de Parme', 16.99),
(NULL, 'Margherita', 16.99),
(NULL, 'Hawaïenne', 16.99),
(NULL, 'Tropicale', 16.99),
(NULL, 'Aloha', 16.99);


INSERT INTO MiseEnAvant VALUES(NULL, 3),
(NULL, 4),
(NULL, 9),
(NULL, 11),
(NULL, 12),
(NULL, 13),
(NULL, 14),
(NULL, 15);


INSERT INTO ContientAllergene VALUES(6, 2),
(10, 5),
(10, 12);


INSERT INTO Livreur VALUES
(NULL, 'William', 'Afton', '$2y$10$1PjL5FUoO3QEnNfH3WsOfeL2yT28JqurjUm2WjHidUX.dCgJxXtHm', 'williamafton@gmail.com'), -- Freddy1
(NULL, 'Mike', 'Shmidt', '$2y$10$kvPDlrWp4Ok8OOmlOEdmwe8x80Y2VPLp.6OG6F3sgyaI3M7uaPbYm', 'idkemail@gmail.com'), -- Bonnie1234
(NULL, 'Jeremy', 'Fitzgerald', '$2y$10$FpnzD9dQD.tzP4pME5fBuO50d8bb5gi/Yzb/wBgS/hrvElN8/JmWC', 'mailmail@gmail.com'); -- ILoveRobots@

INSERT INTO Promotion VALUES
(1, '2000-01-01', '2000-01-01', 30),
(2, '2023-12-23', '2023-12-26', 25);


INSERT INTO TypeProduit (NomTypeProduit) VALUES
('Pizzas'),
('Petite pizzas'), 
('Glaces'),
('Promotion de noel'),
('Vegan'),
('Dessert'),
('Moyenne pizzas'),
('Grandes pizzas');

INSERT INTO Promo_TypeProduit (IDPromotion, IDTypeProduit)VALUES
(1, 1),
(2, 4);

INSERT INTO est_Produit_de VALUES
(6, 1),
(8, 6), 
(7, 3),
(3, 5),
(9, 1),
(2, 1),
(10, 6),
(4, 1),
(5, 6),
(11, 5),
(1, 3),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(15, 8);


INSERT INTO Client VALUES
('Jaimelesdiagrammes','$2y$10$z.GNWH7sFbYI3tPIxLOvc.QVt5u8VKMCjZT9ARI4mcHi0R7zXk1Ye','Alain', 'Vissault','qualite@gmail.com','01.23.45.67.89','7 Le Treuil, 18360 Faverdines',1),
('C++Ccool', '$2y$10$5Epb0CfFTKUnlue0rOHNP.IhCVY8/t1BaER8zqS3aoyqp9SqnjKYC', 'aaa', 'bbbb', 'algorythme@gmail.com', '01.23.45.67.89', 'Samuel Kleinschmidtip Aqqutaa 15, Nuuk 3900, Groenland', 0);


INSERT INTO Commande VALUES
(1, '2002-12-11', NULL, 1, 1, 3, 'Jaimelesdiagrammes');