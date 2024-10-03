<?php
include 'Adminnav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Adding Page</title>
    <link rel="stylesheet" href="Staffadd.css">
</head>
<body>
    <div class="container">
        <h1 class="head2">Add New Staff Member</h1>
        <form action="" method="post">
            <div class="form-group">
                <!--<label for="firstName">First Name:</label>-->
                <input type="text" id="name" name="name" placeholder="Enter the staff name" required>
            </div>
            <div class="form-group">
                <!--<label for="email">Email:</label>-->
                <input type="email" id="email" name="email" placeholder="Enter the email address" required>
            </div>
            <div class="form-group">
                <!--<label for="phone">Phone Number:</label>-->
                <input type="text" id="phone" name="phone" placeholder="Enter the staff Phoneno" required>
            </div>
            <div class="form-group">
                <!--<label for="position">Position:</label>-->
                <input type="password" id="password" name="password" placeholder="Enter the staff Password" required>
            </div>
            <button type="submit" name="submit" class="submit-btn">Add Staff</button>
        </form>
    </div>
</body>
</html>


<?php
$conn= mysqli_connect("localhost","root","","nutritioncalculator");
if($conn){
    // echo "database connected";
    if(isset($_POST['submit'])){
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=$_POST['password'];
$type=1;
if (!preg_match('/^\d{10,15}$/', $phone)) {
    echo "<script>alert('Invalid phone number format. It must be between 10 and 15 digits.')</script>";
} else {
$insert="INSERT INTO `staff` ( `name`, `email`, `phoneno`, `password`) VALUES ('$name','$email','$phone','$password')";
$insert1="INSERT INTO `login` (`email`, `password`, `usertype`) VALUES ('$email','$password','$type')";
$sql=mysqli_query($conn,$insert);
$sql1=mysqli_query($conn,$insert1);
if($sql && $sql1){
    echo "<script>alert('Staff added successfully')</script>";
}
else{
    echo "<script>alert('Staff adding failed')</script>";
    
}
}
}
}
else{
    echo "Database not connected";
}
?>


