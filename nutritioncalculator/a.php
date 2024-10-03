<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" type='text/css' href="css/manage.css">
    <link rel="stylesheet" type='text/css' href="css/card.css">
    <title>Dashboard</title>

</head>

<body>

    <div class="title">
        <span class="heading">User</span>
        <a href="normal_user.php"> <span class="heading">Dashboard</span></a>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-2x">Logout</span></a>
    </div>

    <div class="nav">
        <ul>
      
            <li class="dropdown" onclick="toggleDisplay('2')">
                <a href="profile.php" class="dropbtn">Profile &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="2">
                    <a href="profile.php">Profile</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('3')">
                <a href="#" class="dropbtn">Buy &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="3">
                    <a href="normal_user.php">Buy Tickets</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('3')">
                <a href="#" class="dropbtn">Results &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="3">
                    <a href="user_search_result.php">Search Results</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('2')">
                <a href="#" class="dropbtn">Orders &nbsp
                    <span class="fa fa-angle-down"></span>
                </a>
                <div class="dropdown-content" id="2">
                    <a href="view_order_user.php">View Orders</a>
                </div>
            </li>
        </ul>
    </div>
    <div class="main">
        <?php
        include('init.php');
        include("./auth/userauth.php");

        if (empty($_GET['id'])) {
            header("location:profile.php");
        }
        $id = $_GET['id'];
        $sql = $conn->query("select * from users where usid='$id'");
        $userDetails = $sql->fetch_assoc();
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phno = $_POST['phno'];
            $passwd = $_POST['password'];
            $profileUpdateSql = $conn->query("update users set name='$username',email = '$email',address='$address',phonenum='$phno',password='$passwd' where usid='$id'");
            if($profileUpdateSql)
            {
                echo "<script>alert('Update successfull')</script>";
                header("location:profile.php");
            }
            else
        {
            echo "<script>alert('Update Failed')</script>";

        }
        }
        ?>
        <form method="post">
            <table>
                <tr>
                    <td>Staff Name:</td>
                    <td><input required class="inp" type="text" name="username" id="" value="<?php echo $userDetails['name']; ?>" placeholder="Fullname"><br></td>

                </tr>
                <tr>
                    <td>Email-ID:</td>
                    <td><input required class="inp" type="email" name="email" id="" value="<?php echo $userDetails['email']; ?>"><br></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><textarea required class="inp" type="text" name="address">
                            <?php echo $userDetails['address']; ?>
                            </textarea></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input required class="inp" type="text" name="phno" id="" value="<?php echo $userDetails['phonenum']; ?>"><br></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input required class="inp" type="password" name="password" id="" value="<?php echo $userDetails['password']; ?>"></td>
                </tr>

                <tr>
                    <td></td>
                    <td><button id="hero_bt" type="submit" name="register">update</button></td>
                </tr>
            </table>
        </form>
        </p>
    </div>
    </div>
    </div>
</body>

</html>