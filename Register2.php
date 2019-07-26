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
                <li><a href="Home.php">Home</a></li>
                <li><a href="Login.php">Login</a></li>
                <li class ="active"><a href="#">Register</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="box1">
            <?php
                if(isset($_POST['next']))
                {
                    $username=$_POST['username'];
                    $firstname=$_POST['firstname'];
                    $lastname=$_POST['lastname'];
                    $password=$_POST['password'];
                    $DOB=$_POST['DOB'];
                    $query="select * from customer where username='$username'";
                    $query_run=mysqli_query($con,$query);
                    if(mysqli_num_rows($query_run)==0)
                    {
                        $query="insert into customer(firstname,lastname,username,password,dob) values('$firstname','$lastname','$username','$password','$DOB')";
                        $query_run=mysqli_query($con,$query);
                        $_SESSION['exists']=0;
                    }
                    else
                    {
                        $_SESSION['exists']=1;
                    }
                    $_SESSION['username']=$username;
                }
            ?>
            <form action="#modal" method="post">
                Gender<br><br>
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="transgender">Transgender</option>
                </select>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="number" name="phone" placeholder="Phone" required>  
                <input type="text" name="city" placeholder="City" required>
                <input type="number" name="pin" placeholder="Pin Code" required>    
                <input type="submit" name="register" id="register" value="Register">
            </form>
        </div>
        <div class="modal" id="modal">
            <div class="modal__content">
                <?php
                if(isset($_POST['register']))
                {
                    $temp=$_SESSION['username'];
                    if($_SESSION['exists']==1)
                    {
                        echo '<a href="Register1.php" class="modal__close">&times;</a>';
                        echo '<p class="modal__paragraph"> Username already exists!!';                    
                    }
                    else
                    {
                        $gender=$_POST['gender'];
                        $email=$_POST['email'];
                        $phone=$_POST['phone'];
                        $city=$_POST['city'];
                        $pin=$_POST['pin'];
                        $query="select * from customer_pincode where pincode='$pin'";
                        $query_run=mysqli_query($con,$query);
                        if(mysqli_num_rows($query_run)==0)
                        {
                            $query="insert into customer_pincode values('$pin','$city')";
                            $query_run=mysqli_query($con,$query);
                        }
                        $query="select * from customer_pincode where pincode='$pin' and city='$city'";
                        $query_run=mysqli_query($con,$query);
                        if(mysqli_num_rows($query_run)==0)
                        {
                            echo '<a href="Register2.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Pin and city do not match!!';  
                        }
                        else
                        {
                            $query="update customer set gender='$gender',email='$email',phone='$phone',pincode='$pin' where username='$temp'";
                            $query_run=mysqli_query($con,$query);
                            echo '<a href="Login.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Registered Successfully!!';   
                        } 
                    }
                }
                ?> 
            </div>
        </div>
    </header>
</body>
</html>