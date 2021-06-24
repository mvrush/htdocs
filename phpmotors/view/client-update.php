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
        <title>Account Management | PHP Motors</title>
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
        <h1>Manage Account</h1>
        <h2>Update Account</h2>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
                <label class="top">First Name (required)<input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData']['clientFirstname'])) {echo "value='".$_SESSION['clientData']['clientFirstname']."'";} ?> required></label>
                <label class="top">Last Name (required)<input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($_SESSION['clientData']['clientLastname'])) {echo "value='".$_SESSION['clientData']['clientLastname']."'";} ?> required></label>
                <label class="top">Email (required)<input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail'])) {echo "value='".$_SESSION['clientData']['clientEmail']."'";} ?> required></label>
            <input type="submit" value="Update Info" class="submitBtn">
            <!-- Add the action name-value pair -->
            <input type="hidden" name="action" value="updateAccount">
            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
        </form>

        <h2>Update Password</h2>
            <p>Passwords must be at least 8 characters long and contain at least 1 number, 1 capital letter, 1 lowercase letter and 1 special character</p>
            <p>*note your original password will be changed!</p>
        <?php
        if (isset($messagePassword)) {
            echo $messagePassword;
        }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
            <label class="top">Password<input type="password" id="clientPassword" name="clientPassword" pattern="(?=.*\d)(?=.*\W)(?=.*[a-z])(?=.*[A-Z]).{8,}" ></label>
            <input type="button" onclick="showPass()" value="Show Password" class="submitBtn">
            <input type="submit" value="Update Password" class="submitBtn">
            <!-- Add the action name-value pair -->
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
        </form>
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