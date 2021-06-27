<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters
// at least 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}


// Navigation Function
function navigation() {
    // Get the array of classifications from the function getClassifications() found in the main-model.php
    $classifications = getClassifications();
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}

// Build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetail&invId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '<hr>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetail&invId=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     $dv .= "<span>$".number_format("$vehicle[invPrice]");
     $dv .= "</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;  
}

// Build a display of a single vehciles information
function singleVehicleDisplay($invInfo){
    $dv = "<div class='image-price'>";
    $dv .= "<img src='$invInfo[invImage]' alt='The $invInfo[invMake] $invInfo[invModel]'>";
    $dv .= "<span><h2>Price: $".number_format("$invInfo[invPrice]");
    $dv .= "</h2></span>";
    $dv .= '</div>';
    $dv .= "<div class='vehicle-details'>";
    $dv .= "<h3>$invInfo[invMake] $invInfo[invModel] Details</h3>";
    $dv .= '<ul>';
    $dv .= "<li>$invInfo[invDescription]</li>";
    $dv .= "<li>Color: $invInfo[invColor]</li>";
    $dv .= "<li># in Stock: $invInfo[invStock]</li>";
    $dv .= '</ul>';
    $dv .= '</div>';
    return $dv;
}
