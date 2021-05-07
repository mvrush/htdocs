/* CREATE with Insert Query*/
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

/* UPDATE clientLevel to 3 */
UPDATE clients
SET clientLevel = 3
WHERE clientFirstname = 'Tony' AND clientLastname = 'Stark';

/* UPDATE GM Hummer invDescription*/
UPDATE inventory
SET invDescription = replace(invDescription, 'small', 'spacious')
WHERE invMake = 'GM' AND invModel = 'Hummer';

/* READ with SELECT inventory items the belong to the SUV category */
SELECT invModel, classificationName
FROM inventory
INNER JOIN carclassification
ON inventory.classificationId = carclassification.classificationId
WHERE classificationName = 'SUV';

/* DELETE Jeep Wrangler from database */
DELETE FROM inventory
WHERE invMake = 'Jeep' AND invModel = "Wrangler";

/*UPDATE invImage and invThumbnail to add /phpmotors at beginning of file path */
UPDATE inventory
SET invImage = concat('/phpmotors',invImage), invThumbnail = concat('/phpmotors',invThumbnail);


