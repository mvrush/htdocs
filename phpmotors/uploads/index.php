<?php

/******************** This is the Image uploads controller  ***************/

// Create or access a Session
session_start();

// The following 'require_once' lines bring those files into the controllers scope so that it can access them.
// Get the database connection file. The '../' tells the server to move up a directory level to find the path
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the uploads model
require_once '../model/uploads-model.php';
// Get the functions library found in the 'library' folder
require_once '../library/functions.php';

// call navigation function from the functions library
$navList = navigation();

// Collect the "action" value from the "post" or "get" options of the "request" from the browser
//NOTE: this is the only controller to use FILTER_SANITIZE_STRING here. The others may need that at some point or maybe not.
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

/* * ****************************************************
* Variables for use with the Image Upload Functionality !!NOTE!!: YOU WILL HAVE TO CHANGE THIS DURING ENHANCEMENT 9
* **************************************************** */
// directory name where uploaded images are stored. These variables are used in the 'delete' switch below.
$image_dir = '/phpmotors/uploads/images';
// The path is the full path from the server root
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;


// this "switch" section is the control structure for the controller
switch ($action) {
    case 'upload':
        // Store the incoming vehicle id and primary picture indicator
        $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
        $imgPrimary = filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT);

        // Store the name of the uploaded image
        $imgName = $_FILES['file1']['name'];

        $imageCheck = checkExistingImage($imgName);

        if ($imageCheck) {
            $message = '<p class="notice">An image by that name already exists.</p>';
        } elseif (empty($invId) || empty($imgName)) {
            $message = '<p class="notice">You must select a vehicle and image file for the vehicle.</p>';
        } else {
            // Upload the image, store the returned path to the file
            $imgPath = uploadFile('file1');

            // Insert the image information to the database, get the result
            $result = storeImages($imgPath, $invId, $imgName, $imgPrimary);

            // Set a message based on the insert result
            if ($result) {
                $message = '<p class="notice">The upload succeeded.</p>';
            } else {
                $message = '<p class="notice">Sorry, the upload failed.</p>';
            }
        }

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        header('location: .');
        break;

    case 'delete':
        // Get the image name and id
        $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
        $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);

        // Build the full path to the image to be deleted
        $target = $image_dir_path . '/' . $filename;

        // Check that the file exists in that location
        if (file_exists($target)) {
            // Deletes the file in the folder
            $result = unlink($target);
        }

        // Remove from database only if physical file deleted
        if ($result) {
            $remove = deleteImage($imgId);
        }

        // Set a message based on the delete result
        if ($remove) {
            $message = "<p class='notice'>$filename was successfully deleted.</p>";
        } else {
            $message = "<p class='notice'>$filename was NOT deleted.</p>";
        }

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        header('location: .');
        break;

    default:
        // Call function to return image info from database
        $imageArray = getImages();

        // Build the image information into HTML for display
        if (count($imageArray)) {
            $imageDisplay = buildImageDisplay($imageArray);
        } else {
            $imageDisplay = '<p class="notice">Sorry, no images could be found.</p>';
        }

        // Get vehicles information from database
        $vehicles = getVehicles();
        // Build a select list of vehicle information for the view
        $prodSelect = buildVehiclesSelect($vehicles);

        include '../view/image-admin.php';
        exit;
        break;
}
