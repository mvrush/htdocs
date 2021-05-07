<?php
/*
*Proxy connection to the phpmotors database. This is a PDO connection object.
*/
function phpmotorsConnect(){
$server = 'localhost';
$dbname = 'phpmotors';
$username = 'iClient';
$password = 'sWxGTPb9fANx.k)P';
$dsn = "mysql:host=$server;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $link = new PDO($dsn, $username, $password, $options);
    return $link;
} 
catch(PDOException $e) {
 //echo "It didn't work, error: " . $e->getMessage();
 header('Location: /phpmotors/view/500.php');
 exit;
}
}