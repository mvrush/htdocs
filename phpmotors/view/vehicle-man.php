<?php
// Check if visitor is NOT logged in
    // The exclamation mark is a "negation" operator
    // By adding it the resulting test is reversed
    // This test is now "If Session loggedin value is NOT true"
//if the session variable 'loggedin' is false user will be sent back to the main page
if(!$_SESSION['loggedin'] || ($_SESSION['clientData']['clientLevel'] < 2)) {
    header('Location: /phpmotors/index.php');
    exit; 
    }
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    }
?><!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="PHP Motors is a demonstration of PHP in action">
        <meta name="author" content="Matt Rushton">
        <title>Vehicle Management | PHP Motors</title>
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
        <h1>Vehicle Management</h1>
    <!-- the following php block is not needed on this page (if you use it you'll get 2 success messages)
    <?php
        if (isset($message)) {
            echo $message;
        }
    ?>
    -->
          <ul>
            <li><a href="/phpmotors/vehicles/index.php?action=add-classification">Add Classification</a></li>
            <li><a href="/phpmotors/vehicles/index.php?action=add-vehicle">Add Vehicle</a></li>
            </ul>

        
    <?php
        if (isset($message)) { 
         echo $message; 
        } 
        if (isset($classificationList)) { 
         echo '<h2>Vehicles By Classification</h2>'; 
         echo '<p>Choose a classification to see those vehicles</p>'; 
         echo $classificationList; 
        }
    ?>
    <!-- the following <noscript> tells the browser to detect if JavaScript is disabled. If it is, the message is shown to enable it -->
        <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <table id="inventoryDisplay"></table>

    </div>
        <!-- FOOTER HERE -->
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>
    <script src="/phpmotors/js/scripts.js"></script>
    </body>

</html>
<?php unset($_SESSION['message']); ?>