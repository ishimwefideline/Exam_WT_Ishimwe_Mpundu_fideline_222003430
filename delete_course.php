<?php
include('dbconnection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if CourseID is set
if(isset($_REQUEST['CourseID'])) {
    $CourseID = $_REQUEST['CourseID'];
    
    // Disable foreign key checks temporarily
    $conn->query('SET foreign_key_checks = 0');

    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM courses WHERE CourseID=?");
    $stmt->bind_param("i", $CourseID);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            header("location:course_table.php");
            exit(); // Add exit() after header to prevent further execution
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Course Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="CourseID" value="<?php echo $CourseID; ?>">
            <input type="submit" value="Delete">
        </form>
    </body>
    </html>
    <?php

    // Re-enable foreign key checks
    $conn->query('SET foreign_key_checks = 1');

    $stmt->close();
} else {
    echo "Course ID is not set.";
}

$conn->close();
?>
