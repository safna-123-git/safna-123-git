<?php
$conn = mysqli_connect("localhost", "root", "", "nutritioncalculator");

if ($conn) {
    echo "Database connected";

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $type = 0;

        // Check if email already exists in the 'users' table
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($result) > 0) {
            // If email exists, show an error message
            echo "<script>alert('Email is already registered. Please use a different email.')</script>";
        } else {
            // Validate phone number format
            if (!preg_match('/^\d{10,15}$/', $phone)) {
                echo "<script>alert('Invalid phone number format. It must be between 10 and 15 digits.')</script>";
            } else {
                // Insert new user data into the 'users' table
                $insert = "INSERT INTO `users` (`username`, `email`, `phoneno`, `password`) VALUES ('$name','$email','$phone','$password')";
                // Insert login data into the 'login' table
                $insert1 = "INSERT INTO `login` (`email`, `password`, `usertype`) VALUES ('$email','$password','$type')";

                // Execute both queries
                $sql = mysqli_query($conn, $insert);
                $sql1 = mysqli_query($conn, $insert1);

                // Check if both queries were successful
                if ($sql && $sql1) {
                    header('Location: login.html');
                    echo "Value inserted successfully";
                } else {
                    echo "Value not inserted";
                }
            }
        }
    }
} else {
    echo "Database not connected";
}
?>

<html>

<head>
    <title>Sign up</title>
    <link rel="stylesheet" href="registration.css">
</head>

<body>
    <div class="main">
        <form class="form" action="" method="post">
            <div class="main2">
                <a href="./login.html"><img class="img1" src="./assets/left.png" /></a>
                <h2 class="heading">Sign up</h2>
            </div>
            <input class="input1" type="text" name="name" placeholder="Enter your name" required />
            <input class="input1" type="email" name="email" placeholder="Enter your email" required />
            <input class="input1" type="text" name="phone" placeholder="Enter your phone no:" required />
            <input class="input1" type="password" name="password" placeholder="Enter your password" required />
            <input class="input3" type="submit" name="submit" />
        </form>
    </div>
</body>

</html>
