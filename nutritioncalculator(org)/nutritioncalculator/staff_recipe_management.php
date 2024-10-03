<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Staff.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="nav1">
    <h1 class="head1">RECIPE NUTRITION CALCULATOR</h1>
     <div class="div1">
        <h4 class="head"><a class="a1" href="StaffDashboard.html">Home</a></h4>
        <h4 class="head"><a class="a1" href="staff_recipe_management.php">Recipe management</a></h4>
        <h4 class="head"><a class="a1" href="staff_incrediant_management.php">Ingredient management</a></h4>
        <h4 class="head"><a class="a1" href="login.html">View Feedback</a></h4>
        <h4 class="head"><a class="a1" href="login.html">Logout</a></h4>

     </div>
    </nav>

    <div class="div2">
        <h1>MANAGE INGREDIENT</h1>
        <?php

include 'connection.php';
if (!$con) {
    echo "DB not Connected";
}
    
$sql="SELECT * FROM `recpie`";
$data=mysqli_query($con,$sql);
if($data){
    if(mysqli_num_rows($data)>0){
        echo "<table border=1>";
        echo "<tr>";
        echo "<th>Igredient ID</th>
              <th>Ingredient Name</th>
              <th>Calorie</th>
              <th>Protein</th>
              <th>Fat</th>
              <th>Vitamins</th>
                    </tr> ";
while($row=mysqli_fetch_assoc($data)){
    $id=$row['dishid'];
    echo "<tr>";
    echo "<td>".$row['dishname']."</td>";
    echo "<td>".$row['dishid']."</td>";
    echo "<td>".$row['calorie']."</td>";
    echo "<td>".$row['protein']."</td>";
    echo "<td>".$row['fat']."</td>";
    echo "<td>".$row['vitamin']."</td>";
    echo "<td><form method='post'><button value='{$id}' name='deldish' class='deluser' type='submit'>DELETE</button></form></td>";
    echo "<td><form method='post' action='recipeedit.php'><button value='{$id}' name='recedit' class='deluser' type='submit'>EDIT</button></form></td>";
    echo "</tr>";
}
echo "</table>";
    }
}
?>
    </div>
</body>
</html>

<?php
if(isset($_POST['deldish'])){
    $id=$_POST['deldish'];
    if(!empty($_POST['deldish'])){
    $sql ="DELETE FROM recpie WHERE dishid = '$id'";
    // echo "$sql";
    $data=mysqli_query($con,$sql);
        // echo "<script>alert('Officer deleted successfully')</script>";
        echo "<script>window.replace.location('../rahoof/Staffmanage.php')</script>";
}
}
?>


