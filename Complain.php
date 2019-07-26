<?php
    session_start();
    $con=new mysqli('localhost','root','','carrental') or die("Unable to connect");
?>
<!DOCTYPE html>
<html>
<head>
    <title> CarGo: Rent Cars the Cheapest Way! </title>
    <link rel="stylesheet" type="text/css" href=css/styleold1.css>
    <link rel="stylesheet" type="text/css" href=css/popup.css>
</head>
<body>
    <header>
        <div class="main">
            <ul>
                <li><a href="Welcome.php">Welcome</a></li>
                <li><a href="Book.php">Book</a></li>
                <li><a href="Old.php">Old</a></li>
                <li><a href="Cancel.php">Cancel</a></li>
                <li class ="active"><a href="#">Complain</a></li>
                <li><a href="Profile.php">Profile</a></li>
                <li><a href="Home.php">Logout</a></li>
            </ul>
        </div>
        <div class="box">
            <h2> Complain </h2>
                <form action="#modal" method="post">
                <input type="number" name="bookid" placeholder="Booking ID" required>
                <textarea rows="12" cols="124" name="complaintext" placeholder="Type your complain here...."></textarea>
                <input type="submit" name="complain" value="Complain">
            </form>  
        </div>
        <div class="modal" id="modal">
            <div class="modal__content">
                <?php
                    if(isset($_POST['complain']))
                    {
                        $bookid=$_POST['bookid'];
                        $complain=$_POST['complaintext'];
                        $temp=$_SESSION['username'];
                        $query="select bookid from booking where bookid='$bookid' and username='$temp'";
                        $query_run=mysqli_query($con,$query);
                        if(mysqli_num_rows($query_run)==0)
                        {
                            echo '<a href="Complain.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Wrong Booking ID!!';                    
                        }
                        else
                        {   
                            $query="insert into booking_complain values('$bookid','$complain')";
                            $query_run=mysqli_query($con,$query);
                            echo '<a href="Welcome.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Successfully Complained!! We will look into it soon!!';    
                        }
                    }
                ?> 
            </div>
        </div>
    </header>
</body
</html>