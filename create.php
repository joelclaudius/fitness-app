<?php
// Include config file
require_once "config.php";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $difficulty = $_POST["difficulty"];

    // Prepare SQL statement
    $sql = "INSERT INTO exercises (name, description, difficulty) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssi", $param_name, $param_description, $param_difficulty);

        // Set parameters
        $param_name = $name;
        $param_description = $description;
        $param_difficulty = $difficulty;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to index.php
            header("location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Exercise</title>
    <link rel="stylesheet" href="ProjectProposal/styles.css" />


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
<div class="add-exercise">
    <h2>Add Exercise</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4" cols="50"></textarea>
        </div>
        <div class="form-group">
            <label for="difficulty">Difficulty level: <small><i>on a scale of 1-3</i></small></label>
            <input type="number" class="form-control" id="difficulty" name="difficulty" min="1" max="3" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Exercise</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
