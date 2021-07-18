<?php
//PHP Motors Reviews Model

//insert a review
function insertReview($reviewText, $reviewDate, $invId, $clientId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, reviewDate, invId, clientId)
        VALUES (:reviewText, FROM_UNIXTIME(:reviewDate), :invId, :clientId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
   }

   // get reviews for a specific inventory item
   function getReviewsByInvId($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.invMake, inventory.invModel, reviews.reviewId, reviews.reviewText, reviews.reviewDate, clients.clientFirstname, clients.clientLastname, clients.clientId
            FROM reviews
            INNER JOIN inventory ON reviews.invId=inventory.invId
            INNER JOIN clients ON reviews.clientId=clients.clientId
            WHERE reviews.invId = :invId
            ORDER BY reviews.reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    //can't just use fetch() on the next line. You have to use fechAll().
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;     
   }

   // get reviews written by a specific client
   function getReviewsByClientId($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT i.invMake, i.invModel, i.invId, r.reviewId, r.reviewDate
            FROM reviews r
            INNER JOIN inventory i ON r.invId=i.invId
            WHERE r.clientId=:clientId
            ORDER BY r.reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    //can't just use fetch() on the next line. You have to use fechAll().
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;  
   }

   // get a specific review
   function getReviewById($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, i.invMake, i.invModel FROM reviews r 
            INNER JOIN inventory i ON r.invId=i.invId
             WHERE r.reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $review; 
   }

   // Update a specific review
   function updateReview($reviewId, $reviewText, $reviewDate) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = FROM_UNIXTIME(:reviewDate) WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;  
   }

   // Delete a specific review
function deleteReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
 }