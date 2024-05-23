
<?php
include('dbconnection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ResourceID is set
if(isset($_REQUEST['ResourceID'])) {
    $ResourceID = $_REQUEST['ResourceID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM resources WHERE ResourceID=?");
    $stmt->bind_param("i", $ResourceID);
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
            <input type="hidden" name="ResourceID" value="<?php echo $ResourceID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
      header("location:resources_view.php");
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
    echo "resources is not set.";
}

$conn->close();
?>
