<?php
// Check if visitor is NOT logged in
    // The exclamation mark is a "negation" operator
    // By adding it the resulting test is reversed
    // This test is now "If Session loggedin value is NOT true"
//if the session variable 'loggedin' is false user will be sent back to the main page
if(!$_SESSION['loggedin'] || ($_SESSION['clientData']['clientLevel'] < 2)){
    header('Location: /phpmotors/index.php');
    exit; 
    }
?><!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Add a vehicle to PHP Motors">
        <meta name="author" content="Matt Rushton">
        <!-- When the page loads, the vehicle make and model will appear in the title tab of the browser.
        Or, if the page is returned for error correction the vehicle name will reappear from the vehicle variable. -->
        <title><?php if(isset($invInfo['invMake'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Roboto:wght@300;400;500;700;900&family=Zen+Dots&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/normalize.css"> 
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/styles.css" media="screen">
    </head>
    <body>
    <main>
        <!-- HEADER HERE -->
        <header class="clearfix">
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>

        <!-- NAVIGATION HERE -->
        <nav class="clearfix">
        <!-- <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; ?> -->
        <?php echo $navList; ?>
        </nav>

        <!-- CONTENT HERE -->
    <div class="contentdiv">
        <!-- In the following <h1>, when the page loads, the vehicle make and model will appear in the title field of the page.
        Or, if the page is returned for error correction the vehicle name will reappear from the vehicle variable. -->
        <h1><?php if(isset($invInfo['invMake'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <form action="/phpmotors/vehicles/index.php" method="post">
        <label class="top">*Confirm Vehicle Deletion. THE DELETE IS PERMANENT!</label>
        <label class="top">Make<input list="invMake" name="invMake" placeholder="enter Make" readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";} ?> ></label>
        <datalist id="invMake">
            <option value="Jeep"></option>
            <option value="Ford"></option>
            <option value="Lamborghini"></option>
            <option value="Monster"></option>
        </datalist>
        <label class="top">Model<input type="text" name="invModel" readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";} ?> ></label>
        <label class="top">Description<textarea name="invDescription" cols="30" rows="5" readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription'];} ?></textarea></label>
        <input type="submit" value="DELETE Vehicle" class="submitBtn">
            <!-- Add the action name-value pair -->
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
        </form>
    </div>
        <!-- FOOTER HERE -->
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>
    </body>

</html>