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
    <link rel="stylesheet" href="usermanage.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="div2">
        <h1>MANAGE INGREDIENT</h1>
        <?php

include 'connection.php';
if (!$con) {
    echo "DB not Connected";
}
    
$sql="SELECT * FROM `ingredient`";
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
    $id=$row['ingid'];
    echo "<tr>";
    echo "<td>".$row['ingid']."</td>";
    echo "<td>".$row['ingname']."</td>";
    echo "<td>".$row['calorie']."</td>";
    echo "<td>".$row['protein']."</td>";
    echo "<td>".$row['fat']."</td>";
    echo "<td>".$row['vitamins']."</td>";
    echo "<td><form method='post'><button value='{$id}' name='delingr' class='deluser' type='submit'>DELETE</button></form></td>";
    echo "<td><form method='post' action='ingreedit.php'><button value='{$id}' name='ingredit' class='deluser' type='submit'>EDIT</button></form></td>";
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
if(isset($_POST['delingr'])){
    $id=$_POST['delingr'];
    if(!empty($_POST['delingr'])){
    $sql ="DELETE FROM ingredient WHERE ingid = '$id'";
    // echo "$sql";
    $data=mysqli_query($con,$sql);
        // echo "<script>alert('Officer deleted successfully')</script>";
        echo "<script>window.replace.location('../rahoof/Staffmanage.php')</script>";
}
}
?>