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
        <h1>MANAGE USER</h1>
        <?php

include 'connection.php';
if (!$con) {
    echo "DB not Connected";
}
    
$sql="SELECT * FROM `users`";
$data=mysqli_query($con,$sql);
if($data){
    if(mysqli_num_rows($data)>0){
        echo "<table border=1>";
        echo "<tr>";
        echo "<th>User ID</th>
              <th>Userame</th>
              <th>Email</th>
              <th>Phone No</th>
                    </tr> ";
while($row=mysqli_fetch_assoc($data)){
    $id=$row['userid'];
    echo "<tr>";
    echo "<td>".$row['userid']."</td>";
    echo "<td>".$row['username']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['phoneno']."</td>";
    echo "<td><form method='post'><button value='{$id}' name='deluser' class='deluser' type='submit'>DELETE</button></form></td>";
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
if(isset($_POST['deluser'])){
    $id=$_POST['deluser'];
    if(!empty($_POST['deluser'])){
    $sql ="DELETE FROM users WHERE userid = '$id'";
    // echo "$sql";
    $data=mysqli_query($con,$sql);
        // echo "<script>alert('Officer deleted successfully')</script>";
        echo "<script>window.replace.location('../rahoof/Staffmanage.php')</script>";
}
}
?>