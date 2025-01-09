DELIMITER $$
CREATE TRIGGER `AppliquerReduction` BEFORE UPDATE ON `Commande` FOR EACH ROW BEGIN 
    DECLARE Reduction int DEFAULT 0;
    SELECT ReductionClient into Reduction
    FROM Client
    WHERE Client.Login = NEW.Login;

    IF Reduction = 1 THEN

        UPDATE Client 
        SET ReductionClient = 0 
        WHERE Client.Login = NEW.Login;

        UPDATE Commande
        SET Commande.TotalCommande = NEW.TotalCommande/2
        WHERE Commande.Login = NEW.Login;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CalcPrixCommande` BEFORE INSERT ON `Commande` FOR EACH ROW BEGIN
    DECLARE totalPrix float;
    
    -- Calculer le prix total en fonction des produits et quantités dans la commande
    SELECT SUM(Produit.PrixProduit * LigneCommande.Quantite) INTO totalPrix
    FROM LigneCommande
    JOIN Produit ON Produit.IDProduit = LigneCommande.IDProduit
    WHERE LigneCommande.IDCommande = NEW.IDCommande;

    -- Mettre à jour le prix total dans la table Commande
    SET NEW.TotalCommande = totalPrix;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `MiseAjourStock` AFTER UPDATE ON `Commande` FOR EACH ROW BEGIN 
    DECLARE statutLivraisonID INT;

    SELECT IDStatut INTO statutLivraisonID
    FROM Statut
    WHERE TypeStatut = 'En livraison';

    IF NEW.IDStatut = statutLivraisonID THEN
        UPDATE Stock
        SET quantite = quantite - (
            SELECT quantite
            FROM LigneCommande
            WHERE IDCommande = NEW.IDCommande
        )
        WHERE IDIngredient IN (
            SELECT IDProduit
            FROM LigneCommande
            WHERE IDCommande = NEW.IDCommande
        ) AND IDPizzeria = NEW.IDPizzeria;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `verif_Livraison` BEFORE UPDATE ON `Commande` FOR EACH ROW BEGIN
    DECLARE statutLivraison VARCHAR(20);
    DECLARE Reduc TINYINT(1);

    SELECT NomStatut INTO statutLivraison
    FROM Statut
    WHERE IDStatut = NEW.IDStatut;

	SELECT ReductionClient into Reduc
    from Client
    where Client.Login = NEW.Login;
    
    IF statutLivraison = 'Livré' AND Reduc = 1 THEN
    	UPDATE Client
        SET ReductionClient = 0
        where Client.Login = NEW.Login;
    END IF;

    IF statutLivraison = 'En Livraison' AND TIMEDIFF(NOW(), NEW.DateCommande) > '00:45:00' THEN
    	UPDATE Client
        SET ReductionClient = 0
        where Client.Login = NEW.Login;
    END IF;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `NouveauIngredient` AFTER INSERT ON `Ingredient` FOR EACH ROW BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE laPizzeria INT;

    DECLARE lesPizzerias CURSOR FOR 
        SELECT IDPizzeria 
        FROM Pizzeria;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN lesPizzerias;

    laBoucle: LOOP
        FETCH lesPizzerias INTO laPizzeria;
        
        IF done = 1 THEN 
            LEAVE laBoucle;
        END IF;
        
        IF (SELECT COUNT(*) FROM Stock WHERE Stock.IDPizzeria = laPizzeria AND Stock.IDIngredient = NEW.IDIngredient) = 0 THEN
            INSERT INTO Stock VALUES (NEW.IDIngredient, laPizzeria, 0);
        END IF;
    END LOOP;
    
    CLOSE lesPizzerias;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AppliquerNouvellePromotion` BEFORE UPDATE ON `Promo_TypeProduit` FOR EACH ROW BEGIN
    DECLARE produitID INT;
    DECLARE ancienPourcentagePromotion INT;
    DECLARE nouveauPourcentagePromotion INT;

    SELECT OLD.IDTypeProduit, Promotion.PourcentagePromotion
    INTO produitID, ancienPourcentagePromotion
    FROM Promotion
    JOIN Promo_TypeProduit
    ON Promo_TypeProduit.IDPromotion = Promotion.IDPromotion
    WHERE Promotion.IDPromotion = OLD.IDPromotion;

	UPDATE Produit
	JOIN est_Produit_de ON Produit.IDProduit = est_Produit_de.IDProduit
	SET Produit.PrixProduit = Produit.PrixProduit / (1 - ancienPourcentagePromotion / 100)
	WHERE est_Produit_de.IDTypeProduit = produitID;



    SELECT NEW.IDTypeProduit, Promotion.PourcentagePromotion
    INTO produitID, nouveauPourcentagePromotion
    FROM Promotion
    JOIN Promo_TypeProduit
    ON Promo_TypeProduit.IDPromotion = Promotion.IDPromotion
    WHERE Promotion.IDPromotion = NEW.IDPromotion;

    UPDATE Produit
	JOIN est_Produit_de ON Produit.IDProduit = est_Produit_de.IDProduit
	SET Produit.PrixProduit = Produit.PrixProduit * (1 - nouveauPourcentagePromotion / 100)
	WHERE est_Produit_de.IDTypeProduit = produitID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AppliquerPromotion` AFTER INSERT ON `Promo_TypeProduit` FOR EACH ROW BEGIN
    DECLARE produitID INT;
    DECLARE pourcentagePromotion INT;

    SELECT NEW.IDTypeProduit, Promotion.PourcentagePromotion
    INTO produitID, pourcentagePromotion
    FROM Promotion
    JOIN Promo_TypeProduit
    ON Promo_TypeProduit.IDPromotion = Promotion.IDPromotion
    WHERE Promotion.IDPromotion = NEW.IDPromotion;

    UPDATE Produit
    JOIN est_Produit_de ON est_Produit_de.IDProduit = Produit.IDProduit
    SET PrixProduit = PrixProduit * (1 - pourcentagePromotion / 100)
    WHERE IDTypeProduit = produitID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AppliquerPromotion2` AFTER INSERT ON `Promo_TypeProduit` FOR EACH ROW BEGIN
    DECLARE produitID INT;
    DECLARE pourcentagePromotion INT;

    SELECT NEW.IDTypeProduit, Promotion.PourcentagePromotion
    INTO produitID, pourcentagePromotion
    FROM Promotion
    WHERE Promotion.IDPromotion = NEW.IDPromotion;

    UPDATE Produit
	JOIN est_Produit_de ON Produit.IDProduit = est_Produit_de.IDProduit
    SET Produit.PrixProduit = Produit.PrixProduit * (1 - pourcentagePromotion / 100)
    WHERE est_Produit_de.IDTypeProduit = produitID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AlerteStock` AFTER UPDATE ON `Stock` FOR EACH ROW BEGIN
IF NEW.quantite < 75    THEN
    insert into Alerte VALUES (NEW.IDIngredient, NEW.IDPizzeria, NOW());
END IF;
END
$$
DELIMITER ;
