<?php
    include 'Adminnav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
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

        $sql = "SELECT * FROM `users`";
        $data = mysqli_query($con, $sql);
        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                echo "<table border=1>";
                echo "<tr>";
                echo "<th>User ID</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Phone No</th>
                      <th>Status</th>
                      <th>Actions</th>";
                while ($row = mysqli_fetch_assoc($data)) {
                    $id = $row['userid'];
                    $status = $row['status'];  // Fetch status column
                    echo "<tr>";
                    echo "<td>" . $row['userid'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phoneno'] . "</td>";
                    echo "<td>" . ucfirst($status) . "</td>";  // Display status as 'Active' or 'Inactive'

                    // Show Activate/Deactivate button depending on current status
                    if ($status == 'inactive') {
                        echo "<td>
                                <form method='post'>
                                    <button value='{$id}' name='activate' class='deluser' type='submit'>Activate</button>
                                </form>
                              </td>";
                    } else {
                        echo "<td>
                                <form method='post'>
                                    <button value='{$id}' name='deactivate' class='deluser' type='submit'>Deactivate</button>
                                </form>
                              </td>";
                    }
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
// Handle Activate button
if (isset($_POST['activate'])) {
    $id = $_POST['activate'];
    if (!empty($id)) {
        $sql = "UPDATE users SET status = 'active' WHERE userid = '$id'";
        $data = mysqli_query($con, $sql);
        if ($data) {
            echo "<script>window.location.replace('Usermanage.php');</script>"; // Refresh page
        }
    }
}

// Handle Deactivate button
if (isset($_POST['deactivate'])) {
    $id = $_POST['deactivate'];
    if (!empty($id)) {
        $sql = "UPDATE users SET status = 'inactive' WHERE userid = '$id'";
        $data = mysqli_query($con, $sql);
        if ($data) {
            echo "<script>window.location.replace('Usermanage.php');</script>"; // Refresh page
        }
    }
}
?>
