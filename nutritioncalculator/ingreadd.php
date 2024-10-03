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
        <h1 class="head2">Add New Ingredient</h1>
        <form action="" method="post">
            <div class="form-group">
                <!--<label for="firstName">First Name:</label>-->
                <input type="text" id="ingname" name="ingname" placeholder="Enter the ingredient name" required>
            </div>

            <div class="form-group">
                <!--<label for="firstName">First Name:</label>-->
                <input type="text" id="calorie" name="calorie" placeholder="Enter the calorie" required>
            </div>

            <div class="form-group">
                <!--<label for="firstName">First Name:</label>-->
                <input type="text" id="protein" name="protein" placeholder="Enter the protein" required>
            </div>

            <div class="form-group">
                <!--<label for="firstName">First Name:</label>-->
                <input type="text" id="fat" name="fat" placeholder="Enter the fat" required>
            </div>

            <div class="form-group">
                <!--<label for="firstName">First Name:</label>-->
                <input type="text" id="vitamins" name="vitamins" placeholder="Enter the vitamins " required>
            </div>
            
            <button type="submit" name="submit" class="submit-btn">Add Ingredient</button>
        </form>
    </div>
</body>
</html>


<?php
$conn= mysqli_connect("localhost","root","","nutritioncalculator");
if($conn){
    // echo "database connected";
    if(isset($_POST['submit'])){
$ingname=$_POST['ingname'];
$calorie=$_POST['calorie'];
$protein=$_POST['protein'];
$fat=$_POST['fat'];
$vitamins=$_POST['vitamins'];

$insert="INSERT INTO `ingredient` ( `ingname`, `calorie`, `protein`, `fat`, `vitamins`) VALUES ('$ingname','$calorie','$protein','$fat','$vitamins')";
echo "$insert";
$sql=mysqli_query($conn,$insert);
if($sql){
    header('Location: ingreadd.php');
    echo "Value inserted successfully";
}
else{
    echo "Value not inserted";
}
}
}
else{
    echo "Database not connected";
}
?>