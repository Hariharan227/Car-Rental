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
                <li><a href="Register1.php">Register</a></li>
                <li class ="active"><a href="#">About</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="box">
            <h2> About </h2><br>
            <p>
              This car rental management system primarily serves people who require a temporary vehicle, for example, those who do not own their own car, travellers who are out of town, or owners of damaged or destroyed vehicles who are awaiting repair or insurance compensation.
              <br> The customer will be able to create his own account and his details will be stored in the database. We have divided the cars into various sections according to the seating capacity, cost, model etc. The customer can search for his desired cars for renting under various price categories. 
            </p>
        </div>
    </header>
</body>
</html>