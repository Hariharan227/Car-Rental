<?php
    session_start();
    $con=new mysqli('localhost','root','','carrental') or die("Unable to connect");
?>
<!DOCTYPE html>
<html>
<head>
    <title> CarGo: Rent Cars the Cheapest Way! </title>
    <link rel="stylesheet" type="text/css" href=css/stylereg.css>
    <link rel="stylesheet" type="text/css" href=css/popup.css>
</head>
<body>
    <header>
        <div class="main">
            <ul>
                <li><a href="Welcome.php">Welcome</a></li>
                <li class ="active"><a href="#">Book</a></li>
                <li><a href="Old.php">Old</a></li>
                <li><a href="Cancel.php">Cancel</a></li>
                <li><a href="Complain.php">Complain</a></li>
                <li><a href="Profile.php">Profile</a></li>
                <li><a href="Home.php">Logout</a></li>
            </ul>
        </div>    
        <div class="box">
            <h2> New Booking </h2>
            <form action="#modal" method="post">
                <input type="number" name="minprice" placeholder="Minimum Price" required>
                <input type="number" name="maxprice" placeholder="Maximum Price" required>
                From: <br><br>
                <input type="date" name="from" required>    
                To: <br><br>
                <input type="date" name="to" required>
                <input type="submit" name="search" value="Search">
            </form>  
        </div>
        <div class="modal" id="modal">
            <div class="modal__content">
                <?php
                if(isset($_POST['search']))
                {
                    $minprice=$_POST['minprice'];
                    $maxprice=$_POST['maxprice'];
                    $from=$_POST['from'];
                    $to=$_POST['to'];
                    $_SESSION['minprice']=$_POST['minprice'];
                    $_SESSION['maxprice']=$_POST['maxprice'];
                    $_SESSION['from']=$_POST['from'];
                    $_SESSION['to']=$_POST['to'];
                    date_default_timezone_set("Asia/Kolkata");
                    if($minprice>$maxprice||$from>=$to||$from<date("Y-m-d"))
                    {
                        echo '<a href="Book.php" class="modal__close">&times;</a>';
                        echo '<p class="modal__paragraph"> Invalid price or date range!!';                    
                    }
                    else
                    {
                        $query="select * from car where price>='$minprice' and price<='$maxprice' and carnum not in(select carnum from booking where (start>='$from' and start<='$to') or (end>='$from' and end<='$to') or (start<='$from' and end>='$to'))";
                        $query_run=mysqli_query($con,$query);
                        if(mysqli_num_rows($query_run)==0)
                        {
                            echo '<a href="Book.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Cars not found!!'; 
                        }
                        else
                        {
                            $_SESSION['count']=mysqli_num_rows($query_run);
                            echo '<a href="Options.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Fetched your options!!';    
                        }
                    }
                }
                ?> 
            </div>
        </div>
    </header>
</body>
</html>