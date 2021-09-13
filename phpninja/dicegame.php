<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="utf-8">
        <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="A simple game of dice.">
        <meta name="author" content="Matt Rushton">
        <title>Dice Game</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
    <h1>A game of dice!</h1>
    <h2>If you roll a 7 or an 11, you win! Refresh the browser to roll again.</h2>
    <?php
        $roll = rand(1,11);
        echo '<p>You rolled <strong>' . $roll . '</strong></p>';
            if ($roll == 7 || $roll == 11) {
                echo '<p class="success">You win!🤑</p>';
                echo '<p>You\'re what\'s known as a "winner"!🏆</p>';
            }
            else {
                echo '<p class="failure">Sorry, you didn\'t win, better luck next time!</p>';
                echo '<p>Don\'t walk away a loser, play again!</p>';
            }
    ?>
    </body>
</html>