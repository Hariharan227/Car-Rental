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
                <li><a href="Home.php">Home</a></li>
                <li class ="active"><a href="#">Login</a></li>
                <li><a href="Register1.php">Register</a></li>
                <li><a href="About.php">About</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="box">
            <h2> Login </h2>
            <form action="#modal" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="login" value="Login">
            </form>  
        </div>
        <div class="modal" id="modal">
            <div class="modal__content">
                <?php
                    if(isset($_POST['login']))
                    {
                        $username=$_POST['username'];
                        $password=$_POST['password'];
                        $query="select * from customer where username='$username' and password='$password'";
                        $query_run=mysqli_query($con,$query);
                        if(mysqli_num_rows($query_run)==0)
                        {
                            echo '<a href="Login.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Wrong Credentials!!';                    
                        }
                        else
                        {
                            $_SESSION['username']=$username;
                            echo '<a href="Welcome.php" class="modal__close">&times;</a>';
                            echo '<p class="modal__paragraph"> Logged in!!';    
                        }
                    }
                ?> 
            </div>
        </div>
    </header>
</body>
</html>