<?php
function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters
// at least 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}


// Navigation Function
function navigation()
{
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
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

// Build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetail&invId=$vehicle[invId]'><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
        $dv .= '<hr>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetail&invId=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
        $dv .= "<span>$" . number_format("$vehicle[invPrice]");
        $dv .= "</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

// Build a display of a single vehicles information
function singleVehicleDisplay($invInfo)
{
    $dv = "<div class='image-price'>";
    $dv .= "<img src='$invInfo[imgPath]' alt='The $invInfo[invMake] $invInfo[invModel]'>";
    $dv .= "<h2>Price: $" . number_format("$invInfo[invPrice]");
    $dv .= "</h2>";
    $dv .= '</div>';
    $dv .= "<div class='vehicle-details'>";
    $dv .= "<h3>$invInfo[invMake] $invInfo[invModel] Details</h3>";
    $dv .= '<ul>';
    $dv .= "<li>$invInfo[invDescription]</li>";
    $dv .= "<li><b>Color:</b> $invInfo[invColor]</li>";
    $dv .= "<li><b># in Stock:</b> $invInfo[invStock]</li>";
    $dv .= '</ul>';
    $dv .= '</div>';
    return $dv;
}

// Build thumbnail display to display on single vehicle info view
function singleVehicleThumbnail($thumbs)
{
    $dv = "<h4 class='thumb-h4'>Vehicle Thumbnails</h4>";
    $dv .= "<div class='thumbnail-view'>";
    foreach ($thumbs as $thumb) {
        $dv .= "<img src='$thumb[imgPath]' alt='Thumbnail image titled $thumb[imgName] on phpmotors.com'>";
    }
    $dv .= "</div>";
    return $dv;
}

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name. NOTE: the only problem with this function is if a filename has more than one period '.'
// it may return bad results if more than one period in the filename.
function makeThumbnailName($image)
{
    // strrpos() finds the first occurence of the second argument in the first argument. In this case it finds the first occurence
    // of a period '.' in the $image variable which will be a string.
    // $image variable holds the filename and it finds the position of the period before the file extenstion and $i becomes the number position of the period.
    $i = strrpos($image, '.');
    // substr() arguments are (string, start-position, length). so it starts at the specified position in a string. 0 starts at the first character.
    // in this case it starts at the first character and captures every character up to the period '.' as determined by the $i variable.
    $image_name = substr($image, 0, $i);
    // this substr() creates the extension name by looking at the $i variable as the number to start capturing from. That's everything
    // after the period '.' and that is the extension which gets assigned to the $ext variable.
    $ext = substr($image, $i);
    // this creates the new image name ($image) by taking the old image name ($image_name), concatenating a '-tn' and then
    // concatenating the extension ($ext).
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view. Wrapes the multi-dimensional array up in html for display in the view.
// contains the delete image link.
function buildImageDisplay($imageArray)
{
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
        $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

// Build the vehicles select list.
// Creates a dropdown menu used for image management view.
function buildVehiclesSelect($vehicles)
{
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
        $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name)
{
    // Gets the paths, full and local directory. "global-ized" and brought into the function's scope.
    // makes sure there is a physical file in the PHP $_FILES super global object. The $_FILES super global handles all file uploads.
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename)
{
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
// this is a big function. Read the comments and use PHP.net for details on what all the various PHP functions do.
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height)
{

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    } // ends the switch

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
} // ends resizeImage function


// ***********Reviews helper functions***************
// build username
function userName($clientFirstname, $clientLastname)
{
    $firstInitial = strtoupper(substr($clientFirstname, 0, 1));
    $lastName = ucfirst($clientLastname);
    return $firstInitial . $lastName;
}

// format dates for reviews
function formatReviewDate($dateString) {
    return date ("d F, Y", strtotime($dateString));
}

// display existing reviews on vehicle-detail
function buildInventoryReviewsList($invReviews) {
    $reviews = "<div class='review-list'>";
    foreach ($invReviews as $review) {
        $reviews .= "<div class='single-review'>";
        $screenName = userName($review['clientFirstname'], $review['clientLastname']);
        $reviewDate = formatReviewDate($review['reviewDate']);
        $reviews .= "<h3>$screenName <span class='review-content'>wrote on $reviewDate:</span></h3>";
        $reviews .= "<p>$review[reviewText]</p>";
            if(isset($_SESSION['clientData']) && $_SESSION['clientData']['clientId'] === $review['clientId']) {
                $reviews .= "<span class='review-buttons'>";
                $reviews .= "<a class='modify' href='/phpmotors/reviews?action=modReview&reviewId=$review[reviewId]' title='Click to edit'>Edit </a>";
                $reviews .= "<a class='delete' href='/phpmotors/reviews?action=delete-review&reviewId=$review[reviewId]' title='Click to delete'>Delete</a>";
                $reviews .= "</span>";
            }
            $reviews .= '</div>';
           }
        $reviews .= "</div>";
        return $reviews;
    }

// display existing client reviews in the admin view
// Function for generating existing reviews on the user admin view
function buildClientReviewsList($clientReviews) {
    $reviews = "<table class='admin-review-list'>";
    foreach ($clientReviews as $review) {
        $reviews .= '<tr>';
        $reviewDate =  formatReviewDate($review['reviewDate']);         
        $reviews .= "<td><a href='/phpmotors/vehicles/?action=vehicleDetail&invId=$review[invId]'><span class='label'>$review[invMake] $review[invModel]</span></a> (Reviewed on $reviewDate)</td>"; 
        $reviews .= "<td><a class='grow modify' href='/phpmotors/reviews?action=modReview&reviewId=$review[reviewId]' title='Click to edit'>Edit</a></td>"; 
        $reviews .= "<td><a class='grow delete' href='/phpmotors/reviews?action=deleteReview&reviewId=$review[reviewId]' title='Click to delete'>Delete</a></td>";
        $reviews .= "</tr>";
       }
    $reviews .= "</table>";
    return $reviews;
}


