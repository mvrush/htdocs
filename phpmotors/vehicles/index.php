<?php

/**************** This is the vehicles controller **************/

// Create or access a Session
session_start();

// The following 'require_once' lines bring those files into the controllers scope so that it can access them.
// Get the database connection file. The '../' tells the server to move up a directory level to find the path
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';

/******* Build a navigation bar using the $classifications array (this has been superceded by the navigation() function in the functions library). ****************
 *$navList = '<ul>';
 *$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
 *foreach ($classifications as $classification) {
 * $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
 *}
 *$navList .= '</ul>';
 *The next two lines test our unordered list with links. Uncomment to test.
//echo $navList;
//exit;
 ********************************************************************************/

// call navigation function from functions library
$navList = navigation();


// Get the array of classificationName and classificationId. This function is found in the vehicles-model.php
$classificationid = getClassid();
// The next two lines are used to test the above code and see if it returns the array. Uncomment to use them.
//var_dump($classificationid); //var_dump is a PHP function that displays info about a variable, array or object.
//exit; //the exit directive stops all further processing by PHP

// Build dropdown menu using the $classificationid array (superceded by getClassid() function above.)
// $classList = '<select name="classificationId" required>';
// $classList .= "<option value='' disabled selected>Choose Car Classification &#9662;</option>";
// foreach ($classificationid as $class) {
// $classList .= "<option value='$class[classificationId]'>$class[classificationName]</option>";
// }
// $classList .= '</select>';
// The next two lines test our select box list. Uncomment to test.
//echo $classList;
//exit;


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'addClassification':
        // Filter and store the data
        // FILTER_SANITIZE_STRING removes any html elements and leaves only text.
        // The trim() function removes any white space before or after the value.
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));
        // Check for missing data. The || means "or" so if any of the variables are empty the "if" becomes true.
        if (empty($classificationName)) {
            $message = '<p class="alert">Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }

        // Send the data to the model if no errors exist
        $classOutcome = insertClassification($classificationName);

        // Check and report the result
        if ($classOutcome === 1) {
            // header reloads the page and flushes the cache so you see the new classification in the nav menu
            header('Location: /phpmotors/vehicles/index.php');
            // the following two lines would add a message if you weren't using the above header line
            // $message = "<p class='success'>You have successfully entered $classificationName into the database.</p>";
            // include '../view/vehicle-man.php';
            exit;
        } else {
            $message = "<p class='alert'>Sorry but the $classificationName failed. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;


    case 'addVehicle':
        // Filter and store the data
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));

        // Check for missing data. The || means "or" so if any of the variables are empty the "if" becomes true.
        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p class="alert">Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit;
        }

        // Send the data to the model if no errors exist
        $regOutcome = insertVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);

        // Check and report the result
        if ($regOutcome === 1) {
            $message = "<p class='success'>Thanks for registering your '$invModel'.</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p class='alert'>Sorry, but the $invModel registration failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;

    case 'add-classification':
        include '../view/add-classification.php';
        break;
    case 'add-vehicle':
        include '../view/add-vehicle.php';
        break;

        /************************************ 
         * Get vehicles by classificationId 
         * Used for starting Update & Delete process 
         *********************************** */
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;

        //added case 'mod' in (W09)
        //the view is called when the link is clicked in the vehicle-man.php view. 'mod' is found in the link as a name/value pair. That code is found in the JavaScript and it builds the modify/delete links.
    case 'mod':
        // in the next line 'invId' references the JavaScript name-value pair inserted from the JavaScript to the Delete link on the Vehicle-Man view
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;

        // added case 'updateVehicle' in (W09). It's very similar to the 'addVehicle' case above
    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Check for missing data. The || means "or" so if any of the variables are empty the "if" becomes true.
        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p class="alert">Please complete all information for the item! Double check the classification of the item./p>';
            include '../view/vehicle-update.php';
            exit;
        }

        // Send the data to the model if no errors exist
        $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);

        // Check and report the result NOTE: we no longer write ($updateResult === 1) like the add Vehicle. Now we simply use ($updateResult).
        if ($updateResult) {
            $message = "<p class='success'>Congratulations, the $invMake $invModel was succesfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='alert'>Sorry, but the $invMake $invModel update failed. Please try again.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;

        // del case added in (W09)
        //the view is called when the link is clicked in the vehicle-man.php view. 'mod' is found in the link as a name/value pair. That code is found in the JavaScript and it builds the modify/delete links.
        case 'del':
        // in the next line 'invId' references the JavaScript name-value pair inserted from the JavaScript to the Delete link on the Vehicle-Man view
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;

    case 'deleteVehicle':
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Send the data to the model
        $deleteResult = deleteVehicle($invId);

        // Check and report the result NOTE: we no longer write ($deleteResult === 1) like the add Vehicle. Now we simply use ($deleteResult).
        if ($deleteResult) {
            $message = "<p class='success'>Congratulations, the $invMake $invModel was succesfully deleted. &#x1F60A;</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='alert'>ERROR: $invMake $invModel was not deleted! &#x1F632;</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;

        // (W10) Added the 'classification' case to process the Nav links and make them link to the vehicle classifications.
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        // the getVehiclesByClassification() function is in the vehicles-model.php and gets the vehicles for the classifcation sent with the name/value pair from the nav link.
        $vehicles = getVehiclesByClassification($classificationName);
        // the if-else control checks to see if any vehicles were returned. If No, which is 'if(!count($vehicles)) -the ! means 'not'-, then display $message with the error.
        // if Yes then it builds the array from a custom function called buildVehicleDisplay which is found in the functions.php file.
        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
          } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
          }
        //the next two lines test to see if the $vehicldDisplay is working. Comment them out for final usage.
        //echo $vehicleDisplay;
        //exit;
        include '../view/classification.php';
        break;
    
          // (W10) Added 'vehicleDetail' case to process the links on the classification page and deliver a view.
    case 'vehicleDetail':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getVehicleDetail($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        } else {
            $vehicleInfo = singleVehicleDisplay($invInfo);
        }
        include '../view/vehicle-detail.php';
        break;

    default:
        // (W09) Added the following line to get the variable $classifications from the function getClassifications() which is found in the main-model.php .
        // You could also call the variable $classificationid from the getClassid() function which is found in the vehicles-model.php as they both put
        //  the classificationId from the SQL database into an array. But if you use getClassid() you may need to change code other places.
        $classifications = getClassifications();
        //var_dump($classifications);
        //exit;
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-man.php';
        exit;
        break;
}
