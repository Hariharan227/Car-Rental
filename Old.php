<?php
    session_start();
    $con=new mysqli('localhost','root','','carrental') or die("Unable to connect");
?>
<!DOCTYPE html>
<html>
<head>
    <title> CarGo: Rent Cars the Cheapest Way! </title>
    <link rel="stylesheet" type="text/css" href=css/styleold1.css>
</head>
<body>
    <header>
        <div class="main">
            <ul>
                <li><a href="Welcome.php">Welcome</a></li>
                <li><a href="Book.php">Book</a></li>
                <li class ="active"><a href="#">Old</a></li>
                <li><a href="Cancel.php">Cancel</a></li>
                <li><a href="Complain.php">Complain</a></li>
                <li><a href="Profile.php">Profile</a></li>
                <li><a href="Home.php">Logout</a></li>
            </ul>
        </div>
        <div class="box">
            <h2> Old Bookings </h2>
            <?php
                $temp=$_SESSION['username'];
                $query="select * from booking where username='$temp'";
                $query_run=mysqli_query($con,$query);
                if(mysqli_num_rows($query_run)==0)
                {
                    echo '<br><br> No Bookings Done Yet!!';
                }
                else
                {
                    while($row=mysqli_fetch_assoc($query_run))
                    {
                        echo '<br> Booking ID: '.$row['bookid'].'   Car Number: '.$row['carnum'].'   Start Date: '.$row['start'].'   End Date: '.$row['end'].'   Rent Price: '.$row['rentprice'];
                    }
                }
            ?>
        </div>
    </header>
</body>
</html>