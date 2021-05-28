<?php

/*
 * Vehicles Model
 */

 // Insert a new classification

 function insertClassification($classificationName) {
     // Create a connection object using the phpmotors connection function
     $db = phpmotorsConnect();
     // The SQL statement
     $sql = 'INSERT INTO carclassification (classificationName)
     VALUES (:classificationName)';
     // Create the prepared statement using the phpmotors connection
     $stmt = $db->prepare($sql);
     // The next line replaces the placeholder in the SQL statement with
     // the actual values in the variables and tells the database the type of data it is
     $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
     // Insert the data
     $stmt->execute();
     // Ask how many rows changed as a result of our inster
     $rowsChanged = $stmt->rowCount();
     // Close the database interaction
     $stmt->closeCursor();
     // Return the indication of success (rows changed)
     return $rowsChanged;
 }

 // Get classification list with classificationId

 function getClassid() {
    // Create a connection using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database
    $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationId ASC';
    // Next line Creates a prepared statement using the phpmotors DB connection
    $stmt = $db->prepare($sql);
    // Run the prepared statement
    $stmt->execute();
    // Get data from DB and store as an array in the $classifications variable
    $classificationid = $stmt->fetchAll();
    // Closes the DB interaction
    $stmt->closeCursor();
    // Send the array back to where the function was called (this should be the controller)
    return $classificationid;
}


 // Add Vehicle to Inventory
 
 function insertVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory (classificationId, invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor)
        VALUES (:classificationId, :invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    // The next line may not be PARAM_INT because in the SQL database the data type is decimal(10,0). Also I wrote a price with a comma
    // and it deleted everything after the comma. I changed it to STR but it's still cutting off special characters.
    // TO FIX: I had to change the PHP to PARAM-STR and then I had to go into the SQL database and 
    // change the Data Type from "decimal(10,0)" to "varchar(50)" and it then accepts any value in string form. I changed it back for now.
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
   }
 