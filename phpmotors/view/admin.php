<?php
// Check if visitor is NOT logged in
    // The exclamation mark (!) is a "negation" operator
    // By adding it the resulting test is reversed
    // This test is now "If Session loggedin value is NOT true"
//if the session variable 'loggedin' is false user will be sent back to the main page
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/index.php');
    exit; 
    }
?><!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="PHP Motors is a demonstration of PHP in action">
        <meta name="author" content="Matt Rushton">
        <title>Client Admin | PHP Motors</title>
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
        <h1><?php echo $_SESSION['clientData']['clientFirstname'].' '. $_SESSION['clientData']['clientLastname'] ?></h1>
        <?php
        if (isset($message)) {
            echo $message;
        }
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
        <p>You are logged in.</p>
            <ul class="adminList">
                <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']?></li>
                <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']?></li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail']?></li>
            </ul>
        <h2>Account Management</h2>
        <p>Use this link to update account information:</p>
        <a href="/phpmotors/accounts/index.php?action=mod"><p>Update Account Information</p></a>

<?php
        if($_SESSION['clientData']['clientLevel'] > 1){
    echo "<h2>Inventory Management</h2>";
    echo "<p>Use this link to manage the inventory:</p>";
    echo "<a href='/phpmotors/vehicles/index.php'><p>Manage Vehicles</p></a>";
    }

    $clientReviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
    if($clientReviews) {
        echo "<h2>Manage Your Product Reviews</h2>";
        $reviews = buildClientReviewsList($clientReviews);
        echo $reviews;
    }
?>

        

    </div>
        <!-- FOOTER HERE -->
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>
    </body>

</html>
<?php unset($_SESSION['message']); ?>