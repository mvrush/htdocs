<?php
// Main PHP Motors Model

function getClassifications() {
    // Create a connection using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database
    $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName ASC';
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