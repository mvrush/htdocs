<?php
// this checks for a message set in $_SESSION and if there is it assigns it to a local variable called $message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="PHP Motors is a demonstration of PHP in action">
    <meta name="author" content="Matt Rushton">
    <title>Image Management | PHP Motors</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Roboto:wght@300;400;500;700;900&family=Zen+Dots&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/styles.css" media="screen">
</head>

<body>
    <main>
        <!-- HEADER HERE -->
        <header class="clearfix">
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>

        <!-- NAVIGATION HERE -->
        <nav class="clearfix">
            <!-- <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?> -->
            <?php echo $navList; ?>
        </nav>

        <!-- CONTENT HERE -->
        <div class="contentdiv">
            <div class="image-management">
            <h1>Image Management</h1>
            <p>Choose one of the options below:</p>
            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
                echo $message;
            } ?>

            <!-- In the opening <form> tag, the action="/phpmotors/uploads/" directs the form to send the data to the controller found in the "uploads" folder.
                enctype="multipart/form-data" is required when uploading files. More info can be found on w3schools. -->
            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                <label for="invItem"><h3>Vehicle</h3></label>
                <!-- the PHP echo statement indicates where the select list of the vehicles from the database will be displayed -->
                <?php echo $prodSelect; ?>
                <fieldset>
                    <label>Is this the main image for the vehicle?</label>
                    <label for="priYes" class="pImage">Yes</label>
                    <!-- Notice that both the 'yes' and 'no' inputs have the same name. That means only one can be selected at a time. -->
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
                <label>Upload Image:</label>
                <!-- Input type="file" allows the browser to open the file dialog so you can find and select your file for uploading. -->
                <input type="file" name="file1">
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>

            <hr>
            <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <!-- the follow PHP block shows the $imageDisplay variable which is built in the helper function located in library/functions.php -->
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            } ?>
            
            </div>
        </div>
        <!-- FOOTER HERE -->
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>
</body>

</html>
<?php unset($_SESSION['message']); ?>