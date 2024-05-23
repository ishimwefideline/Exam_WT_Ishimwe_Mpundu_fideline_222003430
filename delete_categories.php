<?php
include('dbconnection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if CategoryID is set
if(isset($_REQUEST['CategoryID'])) {
    $CategoryID = $_REQUEST['CategoryID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM categories WHERE CategoryID=?");
    $stmt->bind_param("i", $CategoryID);
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
            <input type="hidden" name="CategoryID" value="<?php echo $CategoryID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
      header("location:categories_view.php");
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
    echo "categories is not set.";
}

$conn->close();
?>
