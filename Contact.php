<?php
    $con=new mysqli('localhost','root','','carrental') or die("Unable to connect");
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
                <li><a href="Home.php">Home</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Register1.php">Register</a></li>
                <li><a href="About.php">About</a></li>
                <li class ="active"><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="box">
            <h2> Contact </h2>
            <br>Contact us for any queries:
            <br><br><br>Rachana - 2017A7PS0086H
            <br><br>Vaishnavi - 2017A7PS0017H
            <br><br>Jaswanth - 2017A7PS0126H
            <br><br>Hariharan - 2017A7PS0065H
        </div>
    </header>
</body>
</html>