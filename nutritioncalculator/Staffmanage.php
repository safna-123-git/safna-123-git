<?php
include 'Adminnav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
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
        
        $sql = "SELECT * FROM `staff`";
        $data = mysqli_query($con, $sql);
        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                echo "<table border=1>";
                echo "<tr>";
                echo "<th>Staff ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone No</th>
                      <th>Status</th>
                      <th>Actions</th>
                      <th>Edit</th>
                      </tr>";
                while ($row = mysqli_fetch_assoc($data)) {
                    $id = $row['staffid'];
                    $status = $row['status'];
                    $statusButton = $status == 'active' ? 'DEACTIVATE' : 'ACTIVATE';
                    $statusAction = $status == 'active' ? 'deactivate' : 'activate';
                    
                    echo "<tr>";
                    echo "<td>{$row['staffid']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['phoneno']}</td>";
                    echo "<td>{$status}</td>";
                    echo "<td>
                            <form method='post'>
                                <button value='{$id}' name='{$statusAction}' class='deluser' type='submit'>{$statusButton}</button>
                            </form>
                          </td>";
                    echo "<td>
                            <form method='post' action='staffedit.php'>
                                <button value='{$id}' name='staffedit' class='deluser' type='submit'>EDIT</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No staff members found.";
            }
        }
        ?>
    </div>
</body>
</html>

<?php
if (isset($_POST['activate'])) {
    $id = $_POST['activate'];
    $sql = "UPDATE staff SET status = 'active' WHERE staffid = '$id'";
    $data = mysqli_query($con, $sql);
    if ($data) {
        echo "<script>location.reload();</script>";
    } else {
        echo "<script>alert('Error activating staff.')</script>";
    }
}

if (isset($_POST['deactivate'])) {
    $id = $_POST['deactivate'];
    $sql = "UPDATE staff SET status = 'inactive' WHERE staffid = '$id'";
    $data = mysqli_query($con, $sql);
    if ($data) {
        echo "<script>location.reload();</script>";
    } else {
        echo "<script>alert('Error deactivating staff.')</script>";
    }
}
?>
