<?php
    $con=new mysqli('localhost','root','','carrental') or die("Unable to connect");
?>
<!DOCTYPE html>
<html>
<head>
    <title> CarGo: Rent Cars the Cheapest Way! </title>
    <link rel="stylesheet" type="text/css" href=css/stylereg.css>
</head>
<body>
    <header>
        <div class="main">
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Login.php">Login</a></li>
                <li class ="active"><a href="#">Register</a></li>
                <li><a href="About.php">About</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="box">
            <h2> Register </h2>
            <form action="Register2.php" method="post">
                <input type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                DOB: <br><br>
                <input type="date" name="DOB" required>
                <input type="submit" name="next" value="Next">
            </form>  
        </div>
    </header>
</body>
</html>