<?php
/************* This is the main controller ***********/

// Create or access a Session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

// Get the array of classifications (this has been superceded in the functions library).
//$classifications = getClassifications();
// The next two lines are used to test the above code and see if it returns the array. Uncomment to use them.
//var_dump($classifications); //var_dump is a PHP function that displays info about a variable, array or object.
//exit; //the exit directive stops all further processing by PHP

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

// call navigation function from the functions library
$navList = navigation();

// Check if the firstname cookie exists, get its value. Add this to the other controllers to display name after registration
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
   }

$action = filter_input(INPUT_GET, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_POST, 'action');
    }

//some of these cases I don't need. I only put them there to navigate around while I was building stuff.
switch ($action){
    case 'template':
        include 'view/template.php';
        break;
    case 'login':
        include 'view/login.php';
        break;
    case 'registration':
        include 'view/registration.php';
        break;
    case 'vehicle-man':
        include 'view/vehicle-man.php';
        break;
    case 'add-classification':
        include 'view/add-classification.php';
        break;
    case 'add-vehicle':
        include 'view/add-vehicle.php';
        break;

    default:
        include 'view/home.php';    
}
