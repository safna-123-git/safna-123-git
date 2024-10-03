<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Ingredients</title>
    <link rel="stylesheet" href="User.css">
    <link rel="stylesheet" href="ingredient_management.css">
</head>
<body>
    <nav class="nav1">
        <h1 class="head1">RECIPE NUTRITION CALCULATOR</h1>
        <div class="div1">
            <h4 class="head"><a class="a1" href="login.html">Home</a></h4>
            <h4 class="head"><a class="a1" href="user_view_recipie.php">View Recipe</a></h4>
            <h4 class="head"><a class="a1" href="ingredient_management.php">Ingredient Management</a></h4>
            <h4 class="head"><a class="a1" href="login.html">Add Feedback</a></h4>
            <h4 class="head"><a class="a1" href="login.html">Logout</a></h4>
        </div>
    </nav>

    <div class="div2">
        <h1>Manage Ingredients</h1>
        
        <form method="GET" action="">
            <input type="text" id="search-bar" placeholder="Search Ingredients..." />
            <button type="button" id="search-button">Search</button>
        </form>

        <div id="totals" style="margin-top: 20px;">
            <h2>Total Nutritional Values</h2>
            <p>Total Calories: <span id="total-calories">0</span></p>
            <p>Total Protein: <span id="total-protein">0</span></p>
            <p>Total Fat: <span id="total-fat">0</span></p>
            <p>Total carb: <span id="total-vitamins">0</span></p>
        </div>

        <table id="ingredient-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Ingredient Name</th>
                    <th>Calories</th>
                    <th>Protein</th>
                    <th>Fat</th>
                    <th>Carbohydrate</th>
                    <th>Quantity (Teaspoons)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "nutritioncalculator");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM ingredient";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='ingredients[]' value='" . htmlspecialchars($row['ingid']) . "' class='ingredient-checkbox' data-calories='" . htmlspecialchars($row['calorie']) . "' data-protein='" . htmlspecialchars($row['protein']) . "' data-fat='" . htmlspecialchars($row['fat']) . "' data-vitamins='" . htmlspecialchars($row['vitamins']) . "'></td>";
                        echo "<td>" . htmlspecialchars($row['ingname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['calorie']) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row['protein']) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row['fat']) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row['vitamins']) . "</td>"; 
                        echo "<td><input type='number' class='quantity-input' value='1' min='1'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No ingredients found.</td></tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <button id="calculate-button">Calculate Total</button>
        <button id="show-ingredients-button">Show All Ingredients</button>

        <div id="all-ingredients" style="display: none; margin-top: 20px;">
            <h2>All Available Ingredients</h2>
            <ul>
                <?php
                // Fetch all ingredients again for display
                $conn = mysqli_connect("localhost", "root", "", "nutritioncalculator");
                $sql = "SELECT * FROM ingredient";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>" . htmlspecialchars($row['ingname']) . "</li>";
                    }
                } else {
                    echo "<li>No ingredients available.</li>";
                }

                mysqli_close($conn);
                ?>
            </ul>
        </div>
    </div>

    <script>
        document.getElementById('calculate-button').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[name="ingredients[]"]:checked');
            let totalCalories = 0;
            let totalProtein = 0;
            let totalFat = 0;
            let totalVitamins = 0;

            checkboxes.forEach(checkbox => {
                const quantity = parseFloat(checkbox.closest('tr').querySelector('.quantity-input').value);
                totalCalories += parseFloat(checkbox.getAttribute('data-calories')) * quantity;
                totalProtein += parseFloat(checkbox.getAttribute('data-protein')) * quantity;
                totalFat += parseFloat(checkbox.getAttribute('data-fat')) * quantity;
                totalVitamins += parseFloat(checkbox.getAttribute('data-vitamins')) * quantity;
            });

            document.getElementById('total-calories').textContent = totalCalories;
            document.getElementById('total-protein').textContent = totalProtein;
            document.getElementById('total-fat').textContent = totalFat;
            document.getElementById('total-vitamins').textContent = totalVitamins;
        });

        document.getElementById('search-button').addEventListener('click', function() {
            const searchValue = document.getElementById('search-bar').value.toLowerCase();
            const rows = document.querySelectorAll('#ingredient-table tbody tr');

            rows.forEach(row => {
                const ingredientName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (ingredientName.includes(searchValue) || searchValue === "") {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.getElementById('show-ingredients-button').addEventListener('click', function() {
            const ingredientList = document.getElementById('all-ingredients');
            ingredientList.style.display = ingredientList.style.display === 'none' ? 'block' : 'none';
        });

        // Select All functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="ingredients[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
</body>
</html>
