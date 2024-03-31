<?php
// Include config file
require_once "config.php";

// Check if exercise_id is set and not empty
if (isset($_POST['exercise_id']) && !empty($_POST['exercise_id'])) {
    // Prepare a delete statement
    $sql = "DELETE FROM exercises WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = $_POST['exercise_id'];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Exercise deleted successfully, redirect to exercise list page
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
?>
