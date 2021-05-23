<?php
// This is the accounts controller

// Get the database connection file. The '../' tells the server to move up a directory level to find the path
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();
// The next two lines are used to test the above code and see if it returns the array. Uncomment to use them.
//var_dump($classifications); //var_dump is a PHP function that displays info about a variable, array or object.
//	exit; //the exit directive stops all further processing by PHP

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
// The next two lines test our unordered list with links. Uncomment to test.
//echo $navList;
//exit;


$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

switch ($action){
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');

        // Check for missing data. The || means "or" so if any of the variables are empty the "if" becomes true.
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
        $message = '<p class="alert">Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; 
        }

        // Send the data to the model if no errors exist
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

        // Check and report the result
        if($regOutcome === 1){
        $message = "<p class='success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        include '../view/login.php';
        exit;
        } 
        else {
        $message = "<p class='alert'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit;
        }
        break;

        case 'login':
            include '../view/login.php';
            break;
        case 'registration':
            include '../view/registration.php';
            break;

    default:
        
}
