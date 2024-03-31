<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="ProjectProposal/workouts.css" />
  <title>Health and Fitness Tracker</title>
  <style>
    /* CSS to limit image size */
    .exercise-image {
      max-width: 80px;
      max-height: 80px;
    }
    /* CSS for action buttons */
    .btn {
      display: inline-block;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      background-color: #007bff;
      color: #fff;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .btn-danger {
      background-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
    }

    .btn-info {
      background-color: #17a2b8;
    }

    .btn-info:hover {
      background-color: #138496;
    }

    .btn-secondary {
      background-color: #6c757d;
    }

    .btn-secondary:hover {
      background-color: #545b62;
    }

    /* Optionally, adjust button margins for spacing */
    .btn:not(:last-child) {
      margin-right: 8px;
    }
    /* CSS for gym products */
    #gym-products {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .product {
        width: calc(25% - 20px); /* Adjust as needed */
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .product:hover {
        transform: translateY(-5px);
    }

    .product img {
        width: 100%;
        height: auto;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .product-content {
        padding: 15px;
    }

    .product h3 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
    }

    .product p {
        margin-bottom: 10px;
        font-size: 14px;
        color: #666;
    }

    .product button {
        display: block;
        width: 100%;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 0;
        border-radius: 0;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .product button:hover {
        background-color: #0056b3;
    }
    /* CSS for table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    /* CSS for action buttons in the table */
    .action-buttons {
        display: flex;
        justify-content: space-between;
    }

    .action-buttons .btn-delete {
        margin-right: 10px; /* Increased margin for more spacing */
    }


  </style>



</head>

<body>
<header>
  <img src="ProjectProposal/images/logo.jpg" alt="Your Logo">
  <h1>Health and Fitness Tracker</h1>
  <nav>
    <ul>
      <li><a href="index.php">Homepage</a></li>
      <li><a href="ProjectProposal/activity.html">Activity</a></li>
      <li><a href="ProjectProposal/nutrition.html">Nutrition</a></li>
      <li><a href="ProjectProposal/workouts.php">Workouts and Sleep</a></li>
      <li><a href="ProjectProposal/conclusion.html">Conclusion</a></li>
    </ul>
  </nav>
</header>
<div class="container">
  <div class="image-container">
    <img src="ProjectProposal/images/workouts.jpg" alt="Description of the image">
  </div>
  <section id="workouts">
    <h2>Workout Plans and Progress Tracking</h2>

    <p>
      Access a library of curated workout plans suitable for all fitness
      levels. Users can customize their routines and track progress over time.
      The database records workout history, offering insights into muscle
      engagement, calories burned, and overall fitness improvements.
    </p>

    <h3>Current Workouts Available</h3>
    <table>
      <thead>
      <tr>
        <th>Exercise Image</th>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Difficulty</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <?php
            // Include config file
            require_once "config.php";

            // Fetch exercises from database
            $sql = "SELECT * FROM exercises";
            $result = mysqli_query($link, $sql);

            // Check if any exercises exist
            if (mysqli_num_rows($result) > 0) {
      // Display exercises
      while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
        echo "<td><img src='img/" . getRandomImage() . "' alt='Exercise GIF' class='exercise-image'></td>"; // Display a random GIF from the folder
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["difficulty"] . "</td>";
          echo "<td class='action-buttons'>";
          echo "<a href='update.php?id=" . $row["id"] . "' class='btn btn-sm btn-info'><i class='fas fa-edit'></i> Edit</a>";
          echo "<form method='post' action='delete.php' style='display: inline;' onsubmit='return confirm(\"Are you sure you want to delete this exercise?\");'>
    <input type='hidden' name='exercise_id' value='" . $row["id"] . "'>
    <button type='submit' name='delete' class='btn btn-sm btn-danger btn-delete'><i class='fas fa-trash-alt'></i> Delete</button>
</form>";
          echo "<a href='read.php?id=" . $row["id"] . "' class='btn btn-sm btn-secondary'><i class='fas fa-eye'></i> View</a>";
          echo "</td>";


          echo "</tr>";
      }
      } else {
      echo "<tr><td colspan='6'>No exercises found.</td></tr>";
      }

      // Close connection
      mysqli_close($link);

      // Function to get a random image from the folder
      function getRandomImage() {
      $files = glob('img/*.*'); // Get all files in the folder
      $randomFile = $files[array_rand($files)]; // Select a random file
      return basename($randomFile); // Return only the filename
      }
      ?>
      </tbody>

    </table>
      <!-- Button to go to create.php -->
      <a href="create.php" class="btn btn-primary mb-3">Add Exercise</a>


    <h2>Sleep Monitoring and Insights</h2>

    <p>
      Quality sleep is integral to well-being. The application includes sleep
      monitoring features, allowing users to track sleep patterns and receive
      insights for better sleep hygiene. The database stores sleep data,
      facilitating trend analysis and personalized sleep recommendations.
    </p>
  </section>
</div>


<!--<div class="footer1">-->
<!--  <div class="right-foot"><p>&copy; 2024 Sahil Singh Boparai</p></div>-->
<!--  <div class="left-foot"><p>School ID: <b>202105465</b></p></div>-->
<!--</div>-->
<!-- Add a new section for gym products -->
<!-- Add a new section for gym products -->
<h2>Gym Products for Sale</h2>
<section id="gym-products">

    <div class="product">
        <img src="https://5.imimg.com/data5/ZQ/UK/SW/SELLER-87197778/gym-equipments-500x500.jpg" alt="Product Image">
        <h3>Life fitness studio spin bike</h3>
        <p>Heavy duty comercial rear wheel spin </p>
        <p>Price: $950</p>
        <button class="btn btn-info">Add to Cart</button>
    </div>

    <div class="product">
        <img src="https://i.pinimg.com/236x/7e/3a/06/7e3a062585c20278ffd29b13e27ed958.jpg" alt="Product Image">
        <h3>Olympic Incline bench</h3>
        <p>Description: Coated in quality high density rubber</p>
        <p>Price: $750</p>
        <button class="btn btn-info">Add to Cart</button>
    </div>

    <div class="product">
        <img src="https://www.fitness-world.in/wp-content/uploads/2022/10/fitness-world-w1-spin-bike.jpeg" alt="Product Image">
        <h3>Azaki Semi commercial treadmill</h3>
        <p>Description: Fast speed and supply power voltage of ac 220-240v </p>
        <p>Price: $200</p>
        <button class="btn btn-info">Add to Cart</button>
    </div>

    <div class="product">
        <img src="https://s2.r29static.com/bin/entry/b67/x,80/1901022/image.jpg" alt="Product Image">
        <h3>Commercial chin dip leg raise</h3>
        <p>Description: Multifunctional,strong and durable weight free </p>
        <p>Price: $400</p>
        <button class="btn btn-info">Add to Cart</button>
    </div>
</section>

<script>
    // Get all buttons with class 'btn-info' inside the gym products section
    var addToCartButtons = document.querySelectorAll('#gym-products .btn-info');

    // Loop through each button
    addToCartButtons.forEach(function(button) {
        // Add click event listener to each button
        button.addEventListener('click', function() {
            // Show alert when button is clicked
            alert('Item added to cart');

            // Change button text to 'In Cart'
            button.textContent = 'In Cart';

            // Change button color to green
            button.style.backgroundColor = '#28a745';

            // Disable the button after it's been clicked
            button.disabled = true;
        });
    });
</script>

</body>
</html>
