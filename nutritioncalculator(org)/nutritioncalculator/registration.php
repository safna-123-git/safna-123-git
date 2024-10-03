<?php
$conn= mysqli_connect("localhost","root","","nutritioncalculator");
if($conn){
    echo "database connected";
    if(isset($_POST['submit'])){
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=$_POST['password'];
$type=0;
if (!preg_match('/^\d{10,15}$/', $phone)) {
    echo "<script>alert('Invalid phone number format. It must be between 10 and 15 digits.')</script>";
} else {
$insert="INSERT INTO `users` ( `username`, `email`, `phoneno`, `password`) VALUES ('$name','$email','$phone','$password')";
$insert1="INSERT INTO `login` (`email`, `password`, `usertype`) VALUES ('$email','$password','$type')";
$sql=mysqli_query($conn,$insert);   
$sql1=mysqli_query($conn,$insert1);
if($sql && $sql1){
    header('Location: login.html');
    echo "Value inserted successfully";
}
else{
    echo "Value not inserted";
}
}
    }
}
else{
    echo "Database not connected";
}

?>

<html>

<head>
    <title>reg form</title>
    <link rel="stylesheet" href="registration.css">
</head>

<body>
    <div class="main">
    <form class="form" action="" method="post">
        <div class="main2">
             <a href="./login.html"><img class="img1" src="./assets/left.png"/></a>
            <h2 class="heading">Sign up</h2>
        </div>
        <!--<label for="name">Name</label>-->
        <input class="input1" type="text" name="name" placeholder=" Enter your name" />
         <!--<label for="email">Email</label>-->
         <input class="input1" type="email" name="email" placeholder=" Enter your email"/>
        <!-- <label for="phone">Phone no:</label>-->
        <input class="input1" type="text" name="phone" placeholder=" Enter your phone no:"/>
        <!-- <label for="password">Password</label>-->
        <input class="input1" type="password" name="password" placeholder=" Enter your password" />
        <input class="input3" type="submit" name="submit" />
    </form>
</div>
</body>
<html>