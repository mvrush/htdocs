<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="PHP Motors is a demonstration of PHP in action">
        <meta name="author" content="Matt Rushton">
        <title>Account Registration | PHP Motors</title>
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
        <h1>Register</h1>
        <form method="post">
                <label class="top">First Name (required)<input type="text" name="clientFirstname" id="clientFirstname" required></label>
                <label class="top">Last Name (required)<input type="text" name="clientLastname" id="clientLastname" required></label>
                <p>Passwords must be at least 8 characters long and contain at least 1 number, 1 capital letter, 1 lowercase letter and 1 special character
                <label class="top">Password (required)<input type="password" id="clientPassword" name="clientPassword" pattern="(?=.*\d)(?=.*\W)(?=.*[a-z])(?=.*[A-Z]).{8,}" required></label>
            <input type="button" onclick="showPass()" value="Show Password" class="submitBtn">
            <input type="submit" value="Register" class="submitBtn">
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