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
                <li><a href="Options.php">Back</a></li>
                <li><a href="Home.php">Logout</a></li>
            </ul>
        </div>
        <div class="box">
            <h2> Chosen Car </h2>
            <form action="#modal" method="post">
                <input type="text" name="carnum" placeholder="Chosen Car Number" required>
                <input type="submit" name="book" value="Book">
            </form>  
        </div>
        <div class="modal" id="modal">
            <div class="modal__content">
                <?php
                    if(isset($_POST['book']))
                    {
                        $minprice=$_SESSION['minprice'];
                        $maxprice=$_SESSION['maxprice'];
                        $from=$_SESSION['from'];
                        $to=$_SESSION['to'];
                        $query="select * from car where price>='$minprice' and price<='$maxprice' and carnum not in(select carnum from booking where (start>='$from' and start<='$to') or (end>='$from' and end<='$to') or (start<='$from' and end>='$to'))";
                        $query_run=mysqli_query($con,$query);
                        $carnum=$_POST['carnum'];
                        $t=0;
                        while($row=mysqli_fetch_assoc($query_run))
                        {
                            if($row['carnum']==$carnum)
                            {
                                $t=1;
                                break;
                            }
                        }
                        if($t==1)
                        {
                            $_SESSION['carnum']=$carnum; 
                            $temp=$_SESSION['username'];
                            $query="select * from booking where username='$temp'";
                            $query_run=mysqli_query($con,$query);
                            if(mysqli_num_rows($query_run)==4)
                            {
                                $_SESSION['discount']=1;
                                echo '<a href="Payment.php" class="modal__close">&times;</a>';
                                echo '<p class="modal__paragraph"> This is 5th booking!! Get 10% discount!!';
                            }
                            else
                            {
                                $_SESSION['discount']=0;
                                echo '<a href="Payment.php" class="modal__close">&times;</a>';
                                echo '<p class="modal__paragraph"> Proceeding to payment!!';   
                            }
                        }
                        else
                        {
                            echo '<a href="Choose.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Invalid Car Number!!';   
                        }
                    }
                ?> 
            </div>
        </div>
    </header>
</body>
</html>