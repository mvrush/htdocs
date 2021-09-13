<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="utf-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Samples of code written in the PHP programming language.">
        <meta name="author" content="Matt Rushton">
        <title>PHP Code Samples</title>
    </head>
    <body>
        <h1>The following are examples of PHP code in action!</h1>
        <h2> The easiest random number generator I ever programmed.</h2>
        <p>A randomly generated number between 1 and 100 (refresh browser for a new number):
            <?php
            //the next line echos (displays onscreen) the result of the rand() function. Values are a starting and ending number.
                echo rand(1,100);
            ?>
        </p>

        <h2>This is an example of a simple echo command</h2>
       <p> <?php echo 'This is a <strong>test</strong>!'; ?> </p>
    </body>
</html>