<?php
include('dbconnection.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if PaymentID is set
if(isset($_REQUEST['PaymentID'])) {
    $PaymentID = $_REQUEST['PaymentID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM payments WHERE PaymentID=?");
    $stmt->bind_param("i", $PaymentID);
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
            <input type="hidden" name="PaymentID" value="<?php echo $PaymentID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
      header("location:payments_view.php");
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
    echo "payments is not set.";
}

$conn->close();
?>
