<?php
    session_start();
    $con=new mysqli('localhost','root','','carrental') or die("Unable to connect");
?>
<!DOCTYPE html>
<html>
<head>
    <title> CarGo: Rent Cars the Cheapest Way! </title>
    <link rel="stylesheet" type="text/css" href=css/popup.css>
    <style>
    *{
    margin: 0;
    padding: 0;
    font-family: Century Gothic;
    }

body
{
    overflow: hidden;
}

header
{   
    background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(images/2.jpg);
    height: 100vh;
    background-size: cover; 
    background-attachment: fixed;
    background-position: center; 
}

ul
{
    float: right;
    list-style-type: none;  
    margin-top: 20px; 
    margin-right: 10px; 
}

vl
{
    float: left;
    list-style-type: none;  
    margin-top: 20px; 
    margin-left: 10px; 
}

vl li
{
    display: inline-block;
}

vl li a:hover
{
    background-color: #fff;
    color: #1abc9c;
}

vl li a
{
    text-decoration: none;
    color: #ecf0f1;
    padding: 5px 20px;
    border: 1px solid transparent;
    transition: 0.4s ease;
}

vl li.active a
{
    background-color: #fff;
    color: #1abc9c;
}

.main
{
    max-width: 1200px;
    margin: auto;
}

.title
{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}

.title h1
{
    color: #fff;
    font-size: 60px;
}


.box
{
    width: 1000px;
    height: 520px;
    background-color: #000000b3;
    color: #ecf0f1;
    position: absolute;  
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
    padding: 70px 30px;
    box-sizing: border-box;
    border-radius: 10px;
    display: flex;
    flex-wrap: nowrap;
    flex-direction: row;
    align-items: flex-start;
}

h2
{
    margin-top: -20px;
    padding: 0 0 10px;
    text-align: center;
    font-size: 22px;
}

.box input
{
    width: 100%;
    margin-bottom: 20px;
}

.box input[type="text"],input[type="password"],input[type="number"],input[type="email"]
{
    border: none;
    margin-top: 10px;
    border-bottom: 1px solid #ecf0f1;
    background-color: transparent;
    outline: none;
    height: 40px;
    color: #ecf0f1;
    font-size: 16px;
}


.box input[type="submit"]
{
    border: none;
    border-radius: 20px;
    margin-top: 20px;
    background-color: #1abc9c;
    outline: none;
    width: 300px;
    height: 40px;
    color: #ecf0f1;
    font-size: 18px;
}

.page
{
    font-size: 2rem;
    position: fixed;
    z-index: 5;
    padding: 0.25em;
    top: 0;
    right: 0;
    display: flex;
    background: #333;
}

.page a
{
    padding: 0.05em 0.5em;
    text-decoration: none;
    color: #fff;
}

.section
{
    width: 100%;
    height: 100vh;
    margin-left: 350px;
    margin-right: 500px;
    z-index: 0;
    transorm: translateX(0);
    transition: transform 0.7s ease-in-out;
}

.slide
{
    display: none;
}

<?php
    for($i=1;$i<=$_SESSION['count'];$i++)
    {
        $j=($i-1)*(-384);
        echo '.slide[id="'.$i.'"]:target ~ .box .section{transform: translateX('.$j.'%);}';
    }
?>
    </style>
</head>
<body>
    <header>
        <div class="main">
            <vl>
                <li><a href="Home.php">Logout</a></li>
            </vl>
        </div>   
        <?php
            for($i=1;$i<=$_SESSION['count'];$i++)
            {
                echo '<div id="'.$i.'" class="slide"></div>';
            }
        ?>
        <div class="page">
        <?php
            for($i=1;$i<=$_SESSION['count'];$i++)
            {
                echo '<a id="page'.$i.'" href="#'.$i.'">'.$i.'</a>';
            }
        ?>
        </div>
        <div class="box">
        <?php
            $minprice=$_SESSION['minprice'];
            $maxprice=$_SESSION['maxprice'];
            $from=$_SESSION['from'];
            $to=$_SESSION['to'];
            $query="select * from car natural join car_seats where price>='$minprice' and price<='$maxprice' and carnum not in(select carnum from booking where (start>='$from' and start<='$to') or (end>='$from' and end<='$to') or (start<='$from' and end>='$to'))";
            $query_run=mysqli_query($con,$query);
            $i=1;
            while($row=mysqli_fetch_assoc($query_run))
            {
                echo '<div id="'.$i.'" class="section">';
                echo 'Car Number: '.$row['carnum'].'<br><br>';
                echo 'Car Name: '.$row['carname'].'<br><br>';
                echo 'Company: '.$row['company'].'<br><br>';
                echo 'Color: '.$row['color'].'<br><br>';
                echo 'Seating Capacity: '.$row['seats'].'<br><br>';
                echo 'Rent price per day: '.$row['price'].'<br><br>';
                echo 'Insurance Number: '.$row['insnum'].'<br><br>';
                echo 'Insurance Type: '.$row['instype'].'<br><br>';
                echo 'Remember the car number that you want to book!<br><br> ';
                echo '            <form action="Choose.php" method="post">';
                echo '                <input type="submit" name="nxt" value="Next">';
                echo '            </form>  ';
                echo '        </div>';
                $i++;
            }
        ?>
        </div>
    </header>
</body>
</html>