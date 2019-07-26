<?php
    session_start();
    $con=new mysqli('localhost','root','','carrental') or die("Unable to connect");
?>
<!DOCTYPE html>
<html>
<head>
    <title> CarGo: Rent Cars the Cheapest Way! </title>
    <link rel="stylesheet" type="text/css" href=css/style1.css>
    <link rel="stylesheet" type="text/css" href=css/popup.css>
</head>
<body>
    <header>
        <div class="main">
            <ul>
                <li><a href="Welcome.php">Welcome</a></li>
                <li><a href="Book.php">Book</a></li>
                <li><a href="Old.php">Old</a></li>
                <li class ="active"><a href="#">Cancel</a></li>
                <li><a href="Complain.php">Complain</a></li>
                <li><a href="Profile.php">Profile</a></li>
                <li><a href="Home.php">Logout</a></li>
            </ul>
        </div>
        <div class="box"> 
            <h2> Cancel Booking </h2>
            <form action="#modal" method="post">
                <br><input type="text" name="bookid" placeholder="Booking ID" required>
                <br><br><br>
                <input type="submit" name="cancel" value="Cancel">
            </form>
        </div>
        <div class="modal" id="modal">
            <div class="modal__content">
                <?php
                    if(isset($_POST['cancel']))
                    {
                        $bookid=$_POST['bookid'];
                        $temp=$_SESSION['username'];
                        $query="select bookid from booking where bookid='$bookid' and username='$temp'";
                        $query_run=mysqli_query($con,$query);
                        if(mysqli_num_rows($query_run)==0)
                        {
                            echo '<a href="Cancel.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Wrong Booking ID!!';                    
                        }
                        else
                        {   
                            $query="delete from booking where bookid='$bookid'";
                            $query_run=mysqli_query($con,$query);
                            echo '<a href="Old.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Successfully Cancelled!! Price will be refunded!!';    
                        }
                    }
                ?> 
            </div>
        </div>
    </header>
</body>
</html>