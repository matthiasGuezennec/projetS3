-- EVENT QUI RÉAJUSTE LE PRIX APRES LES PROMOTIONS
DELIMITER $$

CREATE EVENT ajuster_prix_produits
ON SCHEDULE EVERY 1 DAY
DO
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE produitID INT;
    DECLARE pourcentagePromotion INT;
    
    DECLARE produitsCursor CURSOR FOR
        SELECT Produit.IDProduit, Promotion.PourcentagePromotion
        FROM Produit
        INNER JOIN EstPromotionne ON Produit.IDTypeProduit = EstPromotionne.IDTypeProduit
        INNER JOIN Promotion ON EstPromotionne.IDPromotion = Promotion.IDPromotion
        WHERE Promotion.DateDebPromotion <= CURDATE();

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN produitsCursor;

    ajuster_prix: LOOP
        FETCH produitsCursor INTO produitID, pourcentagePromotion;

        IF done THEN
            LEAVE ajuster_prix;
        END IF;

        UPDATE Produit
        SET PrixProduit = PrixProduit / (1 - pourcentagePromotion / 100)
        WHERE IDProduit = produitID;
    END LOOP;

    CLOSE produitsCursor;
END $$

DELIMITER ;