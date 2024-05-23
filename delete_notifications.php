<?php
include('dbconnection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if NotificationID is set
if(isset($_REQUEST['NotificationID'])) {
    $NotificationID = $_REQUEST['NotificationID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM notifications WHERE NotificationID=?");
    $stmt->bind_param("i", $NotificationID);
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
            <input type="hidden" name="NotificationID" value="<?php echo $NotificationID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
      header("location:notifications_view.php");
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
    echo "book is not set.";
}

$conn->close();
?>
