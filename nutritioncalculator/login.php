<?php

include 'connection.php';
if (!$con) {
    echo "DB not Connected";
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
    $data = mysqli_query($con, $sql);
    if ($data) {
        if (mysqli_num_rows($data) > 0) {
            $value=mysqli_fetch_assoc($data);
            if($value['usertype']==0){
                header('Location: UserDashboard.html');
                exit();
            }
            
            elseif($value['usertype']==1){
                header('Location: StaffDashboard.html');
                exit();
            }

            else{
                header('Location: AdminDashboard.php');
                exit();
            }
         
        } else {
            echo "<script>alert('User not found')</script>";
        }
    } else {
        echo "<script>alert('Query error')</script>";
    }
} else {
    // echo "Invalid form";
}

?>


<html>
    <head>
        <title>login</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="main">
        <form class="form" method="post" action="">
            <h2 class="heading">Login </h2>
            <!-- <label for="email">Email</label> -->
            <input class="input1" type="email" name="email" placeholder=" Enter your email"/>
            <!-- <label for="password">Password</label> -->
            <input class="input1" type="password" name="password" placeholder=" Enter your password"/>
            <input class="input3" type="submit" name="submit"/>
            <p class="p1">Dont have an account? <a class="a1" href="registration.php">Sign up</a> </p>
        </form>
    </div>
    </body>
</html>