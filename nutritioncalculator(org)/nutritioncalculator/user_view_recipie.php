<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipes</title>
    <link rel="stylesheet" href="User.css">
    <link rel="stylesheet" href="user_view_recipie.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="nav1">
        <h1 class="head1">RECIPE NUTRITION CALCULATOR</h1>
        <div class="div1">
        <h4 class="head"><a class="a1" href="UserDashboard.html">Home</a></h4>
            <h4 class="head"><a class="a1" href="user_view_recipie.php">View Recipe</a></h4>
            <h4 class="head"><a class="a1" href="login.html">Ingredient Management</a></h4>
            <h4 class="head"><a class="a1" href="login.html">Add Feedback</a></h4>
            <h4 class="head"><a class="a1" href="login.html">Logout</a></h4>
        </div>
    </nav>

    <div class="div2">
        <h1>WELCOME USER</h1>

        <!-- Search Bar -->
        <form method="GET" action="" class="search-form">
            <input type="text" name="search" placeholder="Search Recipes..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>

        <h2>Available Recipes</h2>
        <table>
            <thead>
                <tr>
                    <th>Recipe Name</th>
                    <th>Total Calorie</th>
                    <th>Total Protein</th>
                    <th>Total Fat</th>
                    <th>Total Vitamins</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = mysqli_connect("localhost", "root", "", "nutritioncalculator");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Handle search
                $searchQuery = "";
                if (isset($_GET['search'])) {
                    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
                }

                // Fetch recipes
                $sql = "SELECT * FROM recpie" . ($searchQuery ? " WHERE dishname LIKE '%$searchQuery%'" : "");
                $result = mysqli_query($conn, $sql);

                // Check if there are results and display them
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['dishname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['calorie']) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row['protein']) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row['fat']) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row['vitamin']) . "</td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No recipe found.</td></tr>";
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
