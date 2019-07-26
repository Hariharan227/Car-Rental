<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title> CarGo: Rent Cars the Cheapest Way! </title>
    <link rel="stylesheet" type="text/css" href=css/style1.css>
</head>
<body>
    <header>
        <div class="main">
            <ul>
                <li class ="active"><a href="#">Welcome</a></li>
                <li><a href="Book.php">Book</a></li>
                <li><a href="Old.php">Old</a></li>
                <li><a href="Cancel.php">Cancel</a></li>
                <li><a href="Complain.php">Complain</a></li>
                <li><a href="Profile.php">Profile</a></li>
                <li><a href="Home.php">Logout</a></li>
            </ul>
        </div>
        <div class="title">
            <?php
                echo '<h1> Welcome '.$_SESSION['username'].'!!</h1>';
            ?>
        </div>
    </header>
</body>
</html>