<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Add a vehicle to PHP Motors">
        <meta name="author" content="Matt Rushton">
        <title>Add Vehicle | PHP Motors</title>
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
        <h1>Add Vehicle</h1>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <form action="/phpmotors/vehicles/index.php" method="post">
        <label class="top">*Note, all Fields are Required
          <!--(original test code)  <select name="classificationName">
            <option value="" disabled selected>Choose Car Classification &#9662;</option>
            <option value="testvalue">Test Value</option>
            </select> -->
            <?php echo $classList; ?>
        </label>
        <label class="top">Make<input list="invMake" name="invMake" placeholder="enter Make" <?php if(isset($invMake)){echo "value='$invMake'";} ?> required></label>
        <datalist id="invMake">
            <option value="Jeep"></option>
            <option value="Ford"></option>
            <option value="Lamborghini"></option>
            <option value="Monster"></option>
        </datalist>
        <label class="top">Model<input type="text" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} ?> required></label>
        <label class="top">Description<textarea name="invDescription" cols="30" rows="5" required><?php if(isset($invDescription)){echo $invDescription;} ?></textarea></label>
        <label class="top">Image Path<input type="text" name="invImage" value="/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";} ?> required></label>
        <label class="top">Thumbnail Path<input type="text" name="invThumbnail" value="/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required></label>
        <label class="top">Price<input type="number" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required></label>
        <label class="top"># In Stock<input type="number" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required></label>
        <label class="top">Color<input type="text" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} ?> required></label>
        <input type="submit" value="Add Vehicle" class="submitBtn">
            <!-- Add the action name-value pair -->
            <input type="hidden" name="action" value="addVehicle">
        </form>
    </div>
        <!-- FOOTER HERE -->
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>
    </body>

</html>