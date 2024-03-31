<?php
// Include config file
require_once "config.php";

// Initialize variables
$name = $description = $difficulty = "";
$name_err = $description_err = $difficulty_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate description
    if (empty(trim($_POST["description"]))) {
        $description_err = "Please enter a description.";
    } else {
        $description = trim($_POST["description"]);
    }

    // Validate difficulty
    if (empty(trim($_POST["difficulty"]))) {
        $difficulty_err = "Please enter the difficulty level.";
    } else {
        $difficulty = trim($_POST["difficulty"]);
    }

    // Check input errors before updating the database
    if (empty($name_err) && empty($description_err) && empty($difficulty_err)) {
        // Prepare an update statement
        $sql = "UPDATE exercises SET name = ?, description = ?, difficulty = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssii", $param_name, $param_description, $param_difficulty, $param_id);

            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_difficulty = $difficulty;
            $param_id = $_GET["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to index.php
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
} else {
    // Retrieve exercise information based on GET parameter
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
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
    } else {
        // URL doesn't contain ID parameter, redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Exercise</title>
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
    <h2>Edit Exercise</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $_GET["id"]); ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            <span class="text-danger"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?php echo $description; ?></textarea>
            <span class="text-danger"><?php echo $description_err; ?></span>
        </div>
        <div class="form-group">
            <label for="difficulty">Difficulty: <small><i>on a scale of 1-3</i></small></label>
            <input type="number" class="form-control" id="difficulty" name="difficulty" min="1" max="3" value="<?php echo $difficulty; ?>" required>
            <span class="text-danger"><?php echo $difficulty_err; ?></span>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
