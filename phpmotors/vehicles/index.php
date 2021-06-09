<?php
/**************** This is the vehicles controller **************/

// Create or access a Session
session_start();

// Get the database connection file. The '../' tells the server to move up a directory level to find the path
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';

/******* Build a navigation bar using the $classifications array (this has been superceded navigation() function in the functions library). ****************
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


// Get the array of classificationName and classificationId
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
    case 'classification':
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

    default:
    include '../view/vehicle-man.php';
}
