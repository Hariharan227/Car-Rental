<?php
    session_start();
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
                <li><a href="Welcome.php">Welcome</a></li>
                <li><a href="Book.php">Book</a></li>
                <li><a href="Old.php">Old</a></li>
                <li><a href="Cancel.php">Cancel</a></li>
                <li><a href="Complain.php">Complain</a></li>
                <li class ="active"><a href="#">Profile</a></li>
                <li><a href="Home.php">Logout</a></li>
            </ul>
        </div>
        <div class="box">
            <h2> Profile </h2>
            <?php
                $temp=$_SESSION['username'];
                $query="select * from customer where username='$temp'";
                $query_run=mysqli_query($con,$query);
                $pin=0;
                while($row=mysqli_fetch_assoc($query_run))
                {
                    echo '<br>Username: '.$row['username'];
                    echo '<br><br>First Name: '.$row['firstname'];
                    echo '<br><br>Last Name: '.$row['lastname'];
                    echo '<br><br>DOB: '.$row['dob'];
                    echo '<br><br>E-mail: '.$row['email'];
                    echo '<br><br>Gender: '.$row['gender'];
                    echo '<br><br>Phone: '.$row['phone'];
                    $pin=$row['pincode'];
                    echo '<br><br>Pin: '.$row['pincode'];
                }
                $query="select city from customer_pincode where pincode='$pin'";
                $query_run=mysqli_query($con,$query);
                while($row=mysqli_fetch_assoc($query_run))
                {
                    echo '<br><br>City: '.$row['city'];
                }
            ?>
        </div>
    </header>
</body>
</html>