<?php
// This is the main controller

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';

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
$navList .= '';
// The next two lines test our unordered list with links. Uncomment to test.
//echo $navList;
//exit;


$action = filter_input(INPUT_GET, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_POST, 'action');
    }

switch ($action){
    case 'template':
        include 'view/template.php';
        break;

    default:
        include 'view/home.php';    
}
