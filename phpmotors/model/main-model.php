<?php
// Main PHP Motors Model

 //[NOTE! This function is a possible conflict with "function getClassid()" which is found in the
 // model - vehicles-model.php controller and called from the vehicles - index.php controller]
function getClassifications() {
    // Create a connection using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database
    $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC';
    // Next line Creates a prepared statement using the phpmotors DB connection
    $stmt = $db->prepare($sql);
    // Run the prepared statement
    $stmt->execute();
    // Get data from DB and store as an array in the $classifications variable
    $classifications = $stmt->fetchAll();
    // Closes the DB interaction
    $stmt->closeCursor();
    // Send the array back to where the function was called (this should be the controller)
    return $classifications;
}