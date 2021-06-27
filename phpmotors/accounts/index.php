<?php
/******************** This is the accounts controller  ***************/

// Create or access a Session
session_start();

// The following 'require_once' lines bring those files into the controllers scope so that it can access them.
// Get the database connection file. The '../' tells the server to move up a directory level to find the path
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library found in the 'library' folder
require_once '../library/functions.php';

// Get the array of classifications (this has been superceded in the functions library).
//$classifications = getClassifications();
// The next two lines are used to test the above code and see if it returns the array. Uncomment to use them.
//var_dump($classifications); //var_dump is a PHP function that displays info about a variable, array or object.
//	exit; //the exit directive stops all further processing by PHP

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


$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

switch ($action){
    case 'register':
        // Filter and store the data.
        // FILTER_SANITIZE_STRING removes any html elements and leaves only text.
        // The trim() function removes any white space before or after the value.
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for existing email
        $existingEmail = checkExistingEmail($clientEmail);

        // Deal with existing email during registration
        if($existingEmail){
         $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
         include '../view/login.php';
         exit;
        }

        // Check for missing data. The || means "or" so if any of the variables are empty the "if" becomes true.
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
        $message = '<p class="alert">Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // After hashing the password, send the data to the model if no errors exist
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result and if successful set a cookie
        if($regOutcome === 1){
        setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
        // (old line replaced by next line) $message = "<p class='success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        $_SESSION['message'] = "<p class='success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        // (old line replaced by next line) include '../view/login.php';
        header('location: /phpmotors/accounts/?action=login');
        exit;
        } 
        else {
        $message = "<p class='alert'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit;
        }
        break;

        case 'Login':
        // Filter and store the data.
        // FILTER_SANITIZE_STRING removes any html elements and leaves only text.
        // The trim() function removes any white space before or after the value.
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data. The || means "or" so if any of the variables are empty the "if" becomes true.
        if(empty($clientEmail) || empty($checkPassword)){
        $message = '<p class="alert">Please provide a valid email address and password.</p>';
        // The following 'include' line will load the login view again on failure and have correct fields filled in
        // because of the Sticky function of the PHP on the login view input fields.
        include '../view/login.php';
        exit; 
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address. Calls getClient() function in the accounts-model.php
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
          $message = '<p class="notice">Please check your password and try again.</p>';
          include '../view/login.php';
          exit;
        }

        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        // DON'T KNOW IF I NEED THE FOLLOWING break; (I think I do)
        break;

        case 'logout':
            session_unset();
            session_destroy();
        header('Location: /phpmotors/index.php');
        exit;
        break;

        case 'mod':
            // the clientId is stored in the Session array which is available in the session anywhere on the site. So we just need to include the view.
            //the view is called when the link is clicked in the admin.php view. 'mod' is found in the link as a name/value pair.
            
            include '../view/client-update.php';
            break;

        // The following case handles the Account Update process. Added in (W09)
        case 'updateAccount':
            // **NOTE** NEXT TWO LINES POSSIBLY UNNECESSARY(or $cliendData might need to be changed to $clientInfo). Query the client data based on the clientId address. Calls getClient() function in the accounts-model.php
            //$_SESSION['clientData']['clientId'] = $clientId;
            //$clientData = getClientInfo($clientId);
            
            // Filter and store the data.
            // FILTER_SANITIZE_STRING removes any html elements and leaves only text.
            // The trim() function removes any white space before or after the value.
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
            $clientEmail = checkEmail($clientEmail);
    
            // Check to see if entered email is different from the Session data email
            if ($clientEmail != $_SESSION['clientData']['clientEmail']){
            $existingEmail = checkExistingEmail($clientEmail);
    
            // Deal with existing email during registration
            if($existingEmail){
             $message = '<p class="notice">That email address already exists. Use a different email address.</p>';
             include '../view/client-update.php';
             exit;
            }
            }
    
            // Check for missing data. The || means "or" so if any of the variables are empty the "if" becomes true.
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = '<p class="alert">Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
            }
    
    
            // After hashing the password, send the data to the model if no errors exist
            $modifyAccountOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
    
            // Check and report the result and if successful set a cookie
            if($modifyAccountOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            // (old line replaced by next line) $message = "<p class='success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            $_SESSION['message'] = "<p class='success'>$clientFirstname, your information has been updated.</p>";
            //Get updated client data from database to prepare to write the new info into the session variabl
            $clientData = getClientInfo($clientId);
            // Remove the password from the array using
            // the array_pop function which removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            include '../view/admin.php';
            exit;
            } 
            else {
            $message = "<p class='alert'>Sorry $clientFirstname, but the update failed.</p>";
            include '../view/client-update.php';
            exit;
            }
            break;

         // The following case handles the Password Update process
         case 'updatePassword':
            // Filter and store the data.
            // FILTER_SANITIZE_STRING removes any html elements and leaves only text.
            // The trim() function removes any white space before or after the value.
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
            //I'm pulling the following clientId from the form not the session.
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING));
            $checkPassword = checkPassword($clientPassword);
        
            // Check for missing data. The || means "or" so if any of the variables are empty the "if" becomes true.
            if(empty($checkPassword)){
            $messagePassword = '<p class="alert">Please enter a valid password.</p>';
            include '../view/client-update.php';
            exit; 
            }
    
            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    
            // After hashing the password, send the data to the model if no errors exist
            $modifyPasswordOutcome = updatePassword($hashedPassword, $clientId);
    
            // Check and report the result and if successful set a cookie
            if($modifyPasswordOutcome === 1){
            // (old line replaced by next line) $message = "<p class='success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            $_SESSION['message'] = "<p class='success'> Your password has been updated.</p>";
            // (old line replaced by next line) include '../view/login.php';
            include '../view/admin.php';
            exit;
            } 
            else {
            $messagePassword = "<p class='alert'>Sorry but the password update failed.</p>";
            include '../view/client-update.php';
            exit;
            }
            break;



        // The next cases simply deliver views. login has a lower case l and is different from Login above.
        case 'login':
            include '../view/login.php';
            break;
        case 'registration':
            include '../view/registration.php';
            break;
        case 'admin':
            include '../view/admin.php';
            break;
        case 'modifyaccount':
            include '../view/client-update.php';
            break;

    default:
        
}
