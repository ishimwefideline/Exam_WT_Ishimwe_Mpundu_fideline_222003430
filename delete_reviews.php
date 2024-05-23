<?php
include('dbconnection.php');e);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ReviewID is set
if(isset($_REQUEST['ReviewID'])) {
    $ReviewID = $_REQUEST['ReviewID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM reviews WHERE ReviewID=?");
    $stmt->bind_param("i", $ReviewID);
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
            <input type="hidden" name="ReviewID" value="<?php echo $ReviewID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
      header("location:reviews_view.php");
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
    echo "workshops is not set.";
}

$conn->close();
?>
