<?php

/******************** This the Reviews controller  ***************/

// Create or access a Session
session_start();

// The following 'require_once' lines bring those files into the controllers scope so that it can access them.
// Get the database connection file. The '../' tells the server to move up a directory level to find the path
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';
// Get the functions library found in the 'library' folder
require_once '../library/functions.php';

// call navigation function from the functions library
$navList = navigation();

// Collect the "action" value from the "post" or "get" options of the "request" from the browser
//NOTE: only this and the uploads controller use FILTER_SANITIZE_STRING here. The others may need that at some point or maybe not.
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}


// this "switch" section is the control structure for the controller
switch ($action){
    // adds a new review to the database
    case 'addReview':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewDate = time();

        // Check for missing data.
        if (empty($reviewText)) {
            $_SESSION['reviewMessage'] = '<p class="alert">Please write a review in the review field.</p>';
            header("Location: /phpmotors/vehicles/?action=vehicleDetail&invId=$invId");
            exit;
        }

        $addReview = insertReview($reviewText, $reviewDate, $invId, $clientId);

        if ($addReview === 1) {
            $_SESSION['reviewMessage'] = "<p class='success'>Thanks for your review! It is displayed below.</p>";
            header("Location: /phpmotors/vehicles/?action=vehicleDetail&invId=$invId");
            exit;
        }
        break;
    
    // allows user to edit review with Review View. it's like case 'mod' in vehicles controller.
    // This calls the 'review-update.php' view and starts the updateReview update process in the next case statement.
    case 'modReview' :
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
       
        if(empty($reviewId)) {
            header('Location: /phpmotors/accounts');
            exit;
        }

        $review = getReviewById($reviewId);
        include '../view/review-update.php';
        exit;
        break;

    // updates review found in the database
    case 'review-update' :
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewDate = time();

        if(empty($reviewText)) {
            $_SESSION['reviewMessage'] = "<p class='alert'> Review field must be filled in!</p>";
            header("Location: /phpmotors/reviews/?action=modReview&reviewId=$reviewId");
            exit;
        }

        $reviewUpdate = updateReview($reviewId, $reviewText, $reviewDate);
        
        if($reviewUpdate === 1) {
            $_SESSION['message'] = "<p class='success'>Your review was updated successfully.</p>";
            header('Location: /phpmotors/accounts/?action=admin');
        } else {
            $_SESSION['reviewMessage'] = "<p class='alert'>Sorry, an error occurred during update. Please try again.</p>";
            header("Location: /phpmotors/reviews/?action=editReview&reviewId=$reviewId");
            exit;
        }
        exit;
        break;

    // delivers delete review view to confirm review delete and starts the review deletion process.
        case 'deleteReview':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            if(empty($reviewId)) {
                header('Location: /phpmotors/accounts');
                exit;
            }
            
            $review = getReviewById($reviewId);
            include '../view/review-delete.php';
            exit;
            break;

    // completes the review deletion process
        case 'review-delete':
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $reviewDeleted = deleteReview($reviewId);

            if($reviewDeleted === 1) {
                $_SESSION['message'] = "<p class='success'>Review successfully deleted.</p>";
                header('Location: /phpmotors/accounts/?action=admin');
                exit;
            } else {
                $_SESSION['message'] = "<p class='alert'>ERROR delete failed. Please try again.</P>";
                header("Location: /phpmotors/reviews/?action=deleteReview&reviewId=$reviewId");
                exit;
            }
            break;

    // the default returns logged in users to admin view and not logged in users to the homepage
            default:
                header('Location: /phpmotors/accounts');
                break;

}