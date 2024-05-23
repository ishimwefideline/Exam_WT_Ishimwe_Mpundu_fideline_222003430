<?php
include('dbconnection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if InstructorID is set
if(isset($_REQUEST['InstructorID'])) {
    $InstructorID = $_REQUEST['InstructorID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM instructors WHERE InstructorID=?");
    $stmt->bind_param("i", $InstructorID);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="InstructorID" value="<?php echo $InstructorID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
      header("location:instructors_view.php");
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php


    $stmt->close();
} else {
    echo "Instructor is not set.";
}

$conn->close();
?>
