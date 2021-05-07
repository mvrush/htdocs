<?php
/*
*Proxy connection to the phpmotors database
*/
//Use this code for testing your connection to the database.
function phpmotorsConnect(){
$server = 'localhost';
$dbname = 'phpmotors';
$username = 'iClient';
$password = 'sWxGTPb9fANx.k)P';
$dsn = "mysql:host=$server;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $link = new PDO($dsn, $username, $password, $options);
     if(is_object($link)) {
         echo 'It worked!';
     }
} catch(PDOException $e) {
 echo "It didn't work, error: " . $e->getMessage();
}
}
phpmotorsConnect();