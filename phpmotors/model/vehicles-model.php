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

 // Get classification list with classificationId [NOTE! This function is a possible conflict with "function getClassifications()" which is found in the
 // model - main-model.php controller and called from the vehicles - index.php controller]
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

   // Get vehicles by classificationId (added in W09)
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect();
    // remove original SQL statement in (W11) and replace it with the one immediately following the old one
    //$sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
    $sql = ' SELECT invId, invMake, invModel, invDescription, invPrice, invStock, invColor, classificationId FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
   }

   // Added the following function in (W09). I am selecting a single vehicle based on its id with the following function
   // Get vehicle information by invId
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }

   //Added the following updateVehicle function in (W09). It updates the vehicle info.
   function updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE inventory SET classificationId = :classificationId, invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor WHERE invId = :invId';
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
    // The next line was originally PDO::PARAM_INT but in the SQL database the data type was decimal(10,0). So when I wrote a price with a comma
    // it deleted everything after the comma. I changed it to STR but it was still cutting off special characters.
    // TO FIX: I had to change the PHP to PARAM-STR and then I had to go into the SQL database and 
    // change the Data Type from "decimal(10,0)" to "varchar(50)" and it then accepts any value in string form.
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
   }

   //Added the following deleteVehicle function in (W09). It deletes the vehicle info.
   function deleteVehicle($invId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholder in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
   }

   // Added getVehiclesByClassification function in (W10). It is a query with a sub-query that uses the
   // classificationName to get the the information for the classificationId. I says get all the (*) vehicles
   // from inventory where the classificationId matches the id that is attached to the classificationName in the db. It gets the
   // classificationName sent to it from the link in the nav that was clicked which was sent through the Vehicles controller.
   function getVehiclesByClassification($classificationName) {
    $db = phpmotorsConnect();
    //replaced the next line with the line after it in (W11) to pull images from the image table instead of inventory table.
    //$sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $sql = "SELECT inventory.invId, inventory.invMake, inventory.invModel, inventory.invPrice, inventory.classificationId, images.invId, images.imgPath, images.imgName, images.imgPrimary FROM inventory INNER JOIN images ON inventory.invId = images.invId WHERE inventory.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName) AND images.imgName LIKE '%tn.jpg' AND images.imgPrimary = 1";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }

   //added getVehicles() function in (W11). It is used by the Uploads Controller.
   function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

   // Added the following function in (W10) and also used in (W11) for the single vehicle display.
   // I am selecting a single vehicle based on its id with the following function and sending it to functions which creates the HTML for the vehicle-detail view.
   // Get vehicle information by invId
   function getVehicleDetail($invId){
    $db = phpmotorsConnect();
    $sql = "SELECT inventory.invId, inventory.invMake, inventory.invModel, inventory.invPrice, inventory.invDescription, inventory.invColor, inventory.invStock, images.invId, images.imgPath, images.imgName, images.imgPrimary FROM inventory INNER JOIN images ON inventory.invId = images.invId WHERE inventory.invId = :invId AND images.imgName NOT LIKE '%tn.jpg' AND images.imgPrimary = 1";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }
 