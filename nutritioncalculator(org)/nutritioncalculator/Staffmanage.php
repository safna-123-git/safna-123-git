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
    <link rel="stylesheet" href="staffmanage.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="div2">
        <h1>MANAGE STAFF</h1>
        <?php

include 'connection.php';
if (!$con) {
    echo "DB not Connected";
}
    
$sql="SELECT * FROM `staff`";
$data=mysqli_query($con,$sql);
if($data){
    if(mysqli_num_rows($data)>0){
        echo "<table border=1>";
        echo "<tr>";
        echo "<th>Staff ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone No</th>
                    </tr> ";
while($row=mysqli_fetch_assoc($data)){
    $id=$row['staffid'];
    echo "<tr>";
    echo "<td>".$row['staffid']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['phoneno']."</td>";
    echo "<td><form method='post'><button value='{$id}' name='delstaff' class='deluser' type='submit'>DELETE</button></form></td>";
    echo "<td><form method='post' action='staffedit.php'><button value='{$id}' name='staffedit' class='deluser' type='submit'>EDIT</button></form></td>";
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
if(isset($_POST['delstaff'])){
    $id=$_POST['delstaff'];
    if(!empty($_POST['delstaff'])){
    $sql ="DELETE FROM staff WHERE staffid = '$id'";
    // echo "$sql";
    $data=mysqli_query($con,$sql);
        // echo "<script>alert('Officer deleted successfully')</script>";
        echo "<script>window.replace.location('../rahoof/Staffmanage.php')</script>";
}
}
?>
