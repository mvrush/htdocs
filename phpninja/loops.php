<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="utf-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="A simple game of dice.">
        <meta name="author" content="Matt Rushton">
        <title>For Loop</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
    <h1>These are types of PHP loops</h1>
    <h2>This is a <strong>For</strong> loop</h2>
    <h3>It will count from 1 to 10 by ones.</h3>
    <?php
        for ($count = 1; $count <= 10; $count++) {
            echo $count . ' ';
        }
    ?>
    <h2>This is a <strong>While</strong> loop</h2>
    <h3>It will also count from 1 to 10 by ones.</h3>
    <?php
        $count = 1;
        while ($count <= 10) {
            echo $count . ' ';
            ++$count;
        }
    ?>
    </body>
</html>