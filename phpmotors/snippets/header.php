        <div class="headercontent">
        <a href="/phpmotors"><img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo"></a>
        <?php if(isset($_SESSION['loggedin'])){
        echo "<a href='/phpmotors/accounts/index.php?action=logout'><p>Logout</p></a> <a href='/phpmotors/accounts/index.php?action=admin'<p>Welcome ".$_SESSION['clientData']['clientFirstname']."</p>";
        // exit;
        }
        else {
        echo "<a href='/phpmotors/accounts/index.php?action=login'><p>My Account</p></a>";
        }
        ?>
        </div>