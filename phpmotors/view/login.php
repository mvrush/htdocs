<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="PHP Motors is a demonstration of PHP in action">
        <meta name="author" content="Matt Rushton">
        <title>Account Login | PHP Motors</title>
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
        <h1>Sign in</h1>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
                <label class="top">Email (required)<input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required></label>
                <label class="top">Password (required)<input type="password" id="clientPassword" name="clientPassword" pattern="(?=.*\d)(?=.*\W)(?=.*[a-z])(?=.*[A-Z]).{8,}" required></label>
            <input type="submit" value="Sign-in" class="submitBtn">
        <!-- Add the action name-value pair. Remeber, the word 'Login' is different from 'login'. The word 'login' is being used to call the View. -->
        <input type="hidden" name="action" value="Login">
        </form>
        <a href="/phpmotors/accounts/index.php?action=registration">Not a member yet? SIGN UP</a>

    </div>
        <!-- FOOTER HERE -->
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>
    </body>

</html>