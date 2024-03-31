<?php
// Include config file
require_once "config.php";

// Initialize variables
$name = $description = $difficulty = "";
$name_err = $description_err = $difficulty_err = "";
$random_image = getRandomImage(); // Get a random image

// Check if the ID parameter is passed in the URL
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Prepare a select statement
    $sql = "SELECT * FROM exercises WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                // Fetch result row
                $row = mysqli_fetch_assoc($result);
                $name = $row["name"];
                $description = $row["description"];
                $difficulty = $row["difficulty"];
            } else {
                // Exercise ID not found, redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain ID parameter, redirect to error page
    header("location: error.php");
    exit();
}

// Function to get a random image from the folder
function getRandomImage() {
    $files = glob('img/*.*'); // Get all files in the folder
    $randomFile = $files[array_rand($files)]; // Select a random file
    return basename($randomFile); // Return only the filename
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Exercise</title>
    <link rel="stylesheet" href="ProjectProposal/styles.css" />
    <style>

    </style>

</head>
<body>
<header>
    <img src="ProjectProposal/images/logo.jpg" alt="Your Logo">
    <h1>PROJECT PROPOSAL</h1>
    <nav>
        <ul>
            <li><a href="index.php">Homepage</a></li>
            <li><a href="ProjectProposal/activity.html">Activity</a></li>
            <li><a href="ProjectProposal/nutrition.html">Nutrition</a></li>
            <li><a href="workouts.php">Workouts and Sleep</a></li>
            <li><a href="ProjectProposal/conclusion.html">Conclusion</a></li>
        </ul>
    </nav>
</header>
<div class="exercise-details">
    <h2>Exercise Details</h2>
    <!-- Display random image -->
    <img src="img/<?php echo $random_image; ?>" alt="Random Exercise GIF" class="exercise-image">
    <p><strong>Name:</strong> <?php echo $name; ?></p>
    <p><strong>Description:</strong> <?php echo $description; ?></p>
    <p><strong>Difficulty: </strong> <?php echo $difficulty; ?></p>
    <p><a href="index.php" class="btn">Back to Exercise List</a></p>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
