<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="PHP Motors is a demonstration of PHP in action">
        <meta name="author" content="Matt Rushton">
        <title>Update Review | PHP Motors</title>
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
    <h1><?php echo $review['invMake'] . ' ' . $review['invModel'] ?> Review </h1>
    <p>Reviewed on <?php echo formatReviewDate($review['reviewDate']) ?></p>
    <?php
        if (isset($_SESSION['reviewMessage'])) {
            echo $_SESSION['reviewMessage'];
        }
    ?>
    <form class="review-form" action="/phpmotors/reviews/index.php" method="post">
        <div>
            <label for="reviewText">Review Text</label><br>
            <textarea cols=35 rows=5 name="reviewText" required><?php echo $review['reviewText'] ?></textarea>
        </div>
        <div>
            <input type="submit" value="Update Review" class="submitBtn">
        </div>
        <!-- action/value pairs follow -->
        <input type="hidden" name="action" value="review-update">
        <input type="hidden" name="reviewId" value="<?php echo $reviewId ?>">       
    </form>

    </div>
        <!-- FOOTER HERE -->
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>
    </body>

</html>
<?php unset($_SESSION['reviewMessage']);