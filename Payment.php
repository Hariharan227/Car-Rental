<?php
    session_start();
    $con=new mysqli('localhost','root','','carrental') or die("Unable to connect");
?>
<!DOCTYPE html>
<html>
<head>
    <title> CarGo: Rent Cars the Cheapest Way! </title>
    <link rel="stylesheet" type="text/css" href=css/stylereg.css>
    <link rel="stylesheet" type="text/css" href=css/styledet.css>
    <link rel="stylesheet" type="text/css" href=css/popup.css>
</head>
<body>
    <header>     
        <div class="main">
            <vl>
                <li><a href="Options.php">Back</a></li>
            </vl>
            <ul>
                <li><a href="Home.php">Logout</a></li>
            </ul>
        </div>   
        <div class="box">
            <h2> Payment </h2>
            <form action="#modal" method="post">
                <?php
                    $to=$_SESSION['to'];
                    $from=$_SESSION['from'];
                    $carnum=$_SESSION['carnum'];
                    $query="select price from car where carnum='$carnum'";
                    $query_run=mysqli_query($con,$query);
                    while($row=mysqli_fetch_assoc($query_run))
                    {
                        $price=$row['price'];
                    }
                    $diff = abs(strtotime((string)$to) - strtotime((string)$from));
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                    $tot=$price*$days;
                    if($_SESSION['discount']==1)
                    {
                        $tot=floor($tot*0.9);
                    }
                    echo '<br><br>Total Amount Payable: Rs '.$tot.' <br><br><br>';
                    $_SESSION['tot']=$tot;
                ?>
                Payment Mode<br><br>
                <select name="paymode">
                    <option value="debit">Debit Card</option>
                    <option value="credit">Credit Card</option>
                    <option value="paytm">Paytm</option>
                </select>
                <br><br>
                <input type="number" name="paynum" placeholder="Credit/Debit/Paytm Number" required>  
                <br><br>  
                <input type="submit" name="pay" value="Pay">
            </form>  
        </div>
        <div class="modal" id="modal">
            <div class="modal__content">
                <?php
                if(isset($_POST['pay']))
                {
                    $query="select bookid from booking";
                    $query_run=mysqli_query($con,$query);
                    $bid=9999;
                    while($row=mysqli_fetch_assoc($query_run))
                    {
                        $bid=$row['bookid'];
                    }
                    if($bid==9999)
                    {
                        $bid=10000;
                    }
                    else
                    {
                        $bid++;
                    }
                    $start=$_SESSION['from'];
                    $end=$_SESSION['to'];
                    $carnum=$_SESSION['carnum'];
                    $user=$_SESSION['username'];
                    $tot=$_SESSION['tot'];
                    $paymode=$_POST['paymode'];
                    $paynum=$_POST['paynum'];
                    $query="insert into booking values('$bid','$user','$carnum','$start','$end','$tot','$paymode','$paynum')";
                    $query_run=mysqli_query($con,$query);
                    echo '<a href="Old.php" class="modal__close">&times;</a>';
                    echo '<p class="modal__paragraph"> Payment Successful!! Booking ID: '.$bid;    
                }
                ?> 
            </div>
        </div>
    </header>
</body>
</html>