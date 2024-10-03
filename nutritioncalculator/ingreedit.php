<?php
    include 'Adminnav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Admin.css">
    <link rel="stylesheet" href="staffedit.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="div2">
        <h1>MANAGE STAFF</h1>
        <?php
        if (isset($_POST['ingredit'])) {
            $id = $_POST['ingredit'];
            $conn = mysqli_connect("localhost", "root", "", "nutritioncalculator");
             
                $sql = $conn->query("SELECT * FROM `ingredient` WHERE `ingid`='$id'");
                $userDetails = $sql->fetch_assoc();
                
                if (isset($_POST['register'])) {
                    $username = $_POST['username'];
                    $calorie = $_POST['calorie'];
                    $protein = $_POST['protein'];
                    $fat = $_POST['fat'];
                    $vitamin = $_POST['vitamin'];
                    $profileUpdateSql = $conn->query(" UPDATE `ingredient` SET `ingname`='$username',`calorie`='$calorie',`protein`='$protein',`fat`='$fat',`vitamins`='$vitamin' WHERE `ingid`='$id'");
                    
                    if ($profileUpdateSql) {
                        echo "<script>alert('Update successful')</script>";
                        header("Location: ingremanage.php");
                        exit();
                    } else {
                        echo "<script>alert('Update Failed')</script>";
                    }
                }
            } else {
                echo "Database connection failed.";
            }   
        ?>
        <form method="post">
            <input type="hidden" name="ingredit" value="<?php echo htmlspecialchars($id); ?>">
            <table>
                <tr>
                    <td>Ingredient Name:</td>
                    <td><input required class="inp" type="text" name="username" value="<?php echo htmlspecialchars($userDetails['ingname']); ?>" placeholder="Fullname"><br></td>
                </tr>
                <tr>
                    <td>Calorie:</td>
                    <td><input required class="inp" type="text" name="calorie" value="<?php echo htmlspecialchars($userDetails['calorie']); ?>"><br></td>
                </tr>
                <tr>
                    <td>Protein:</td>
                    <td><input required class="inp" type="text" name="protein" value="<?php echo htmlspecialchars($userDetails['protein']); ?>"><br></td>
                </tr>
                <tr>
                    <td>fat:</td>
                    <td><input required class="inp" type="text" name="fat" value="<?php echo htmlspecialchars($userDetails['fat']); ?>"></td>
                </tr>
                <tr>
                    <td>vitamins:</td>
                    <td><input required class="inp" type="text" name="vitamin" value="<?php echo htmlspecialchars($userDetails['vitamins']); ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button id="hero_bt" type="submit" name="register">Update</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
