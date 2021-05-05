<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="PHP Motors is a demonstration of PHP in action">
        <meta name="author" content="Matt Rushton">
        <title>Home | PHP Motors</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Roboto:wght@300;400;500;700;900&family=Zen+Dots&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/normalize.css"> 
        <link rel="stylesheet" type="text/css" href="css/styles.css" media="screen">
    </head>
    <body>
        <main>
        <!-- HEADER HERE -->
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>

        <!-- NAVIGATION HERE -->
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; ?>

        <!-- CONTENT HERE -->
    <div class="contentdiv">
        <h1>Welcome to PHP Motors!</h1>
        <div class="imageandcall">
            <aside class="calltoaction">
                <h2>DMC Delorean</h2>
                <ul>
                    <li>3 Cup holders</li>
                    <li>Superman doors</li>
                    <li>Fuzzy dice!</li>
                </ul>
            </aside>
                <img src="images/delorean.jpg" alt="DeLorean automobile">
                <button id="actionButton" class="myButton">Own Today</button>
        </div>
        <div class="reviewupgradediv">
        <article>
        <h2>DMC Delorean Reviews</h2>
        <ul>
            <li>"So fast it's almost like travling in time." (4/5)</li>
            <li>"Coolest ride on the the road." (4/5)</li>
            <li>"I'm feeling Marty McFly!" (5/5)</li>
            <li>"The most futuristic ride of our day" (4.4/5)</li>
            <li>"80's livin' and I love it!" (5/5)</li>
        </ul>
        </article> 
        <section class="upgrades">
            <h2>Delorean Upgrades</h2>          
            <div>
               <img src="images/upgrades/flux-cap.png" alt="flux capacitor">
            </div>
                <p><a href="#">Flux Capacitor</a></p>
            <div>
                <img src="images/upgrades/flame.jpg" alt="flame decals">
            </div>
                <p><a href="#">Flame Decals</a></p>
             <div>
                <img src="images/upgrades/bumper_sticker.jpg" alt="bumper sticker">
            </div>
                <p><a href="#">Bumper Stickers</a></p>
             <div>
                <img src="images/upgrades/hub-cap.jpg" alt="hub cap">
            </div>
                <p><a href="#">Hub Caps</a></p>         
        </section>
        </div>


    </div>

        <!-- FOOTER HERE -->
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

    </main>
    </body>

</html>