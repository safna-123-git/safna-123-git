<?php
include 'connection.php';
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    $sql_login = "SELECT * FROM login WHERE email='$email' AND password='$password'";
    $data_login = mysqli_query($con, $sql_login);

    if ($data_login && mysqli_num_rows($data_login) > 0) {
        $login_data = mysqli_fetch_assoc($data_login);

        if ($login_data['usertype'] == 0) {
            $sql_user = "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='active'";
            $data_user = mysqli_query($con, $sql_user);
            if ($data_user && mysqli_num_rows($data_user) > 0) {
                header('Location: UserDashboard.html');
                exit();
            } else {
                echo "<script>alert('Your account is either inactive or incorrect details. Please contact support.')</script>";
            }
        } elseif ($login_data['usertype'] == 1) {
            $sql_staff = "SELECT * FROM staff WHERE email='$email' AND password='$password' AND status='active'";
            $data_staff = mysqli_query($con, $sql_staff);
            if ($data_staff && mysqli_num_rows($data_staff) > 0) {
                header('Location: StaffDashboard.html');
                exit();
            } else {
                echo "<script>alert('Your account is either inactive or incorrect details. Please contact support.')</script>";
            }
        } else {
                header('Location: adminDashboard.php');
                exit();
        }
    } else {
        echo "<script>alert('Invalid email or password. Please try again.')</script>";
    }
}
?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="main">
        <form class="form" method="post" action="">
            <h2 class="heading">Login</h2>
            <!-- Email input field -->
            <input class="input1" type="email" name="email" placeholder="Enter your email" required/>
            <!-- Password input field -->
            <input class="input1" type="password" name="password" placeholder="Enter your password" required/>
            <input class="input3" type="submit" name="submit" value="Login"/>
            <p class="p1">Don't have an account? <a class="a1" href="registration.php">Sign up</a> </p>
        </form>
    </div>
    </body>
</html>
