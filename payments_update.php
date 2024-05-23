<?php
include('dbconnection.php');

if(isset($_REQUEST['PaymentID'])) {
    $PaymentID = $_REQUEST['PaymentID'];
    
    // Prepare and execute SELECT statement to retrieve attendee details
    $stmt = $connection->prepare("SELECT * FROM payments WHERE PaymentID = ?");
    $stmt->bind_param("i", $PaymentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['PaymentID'];
        $z = $row['UserID'];
        $y = $row['Amount'];
        $e = $row['PaymentDate'];
         $e = $row['PaymentMethod'];
    } else {
        echo "payments not found.";
    }
}

?>

<html>
<head>
    <title>Update payments</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="PaymentID">PaymentID:</label>
        <input type="number" name="PaymentID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="Amount">Amount:</label>
        <input type="number" name="Amount" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="PaymentDate">PaymentDate:</label>
        <input type="date" name="PaymentDate" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="PaymentMethod">PaymentMethod:</label>
        <input type="text" name="PaymentMethod" value="<?php echo isset($g) ? $e : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $PaymentID = $_POST['PaymentID'];
    $UserID = $_POST['UserID'];
    $Amount = $_POST['Amount'];
    $PaymentDate = $_POST['PaymentDate'];
    $PaymentMethod = $_POST['PaymentMethod'];
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payments SET UserID=?, Amount=?, PaymentDate=?, PaymentMethod=? WHERE PaymentID=?");
    $stmt->bind_param("issss", $UserID, $Amount, $PaymentDate, $PaymentMethod, $PaymentID);
    
    if ($stmt->execute()) {
        // Redirect to view page after successful update
        header('Location: payments_view.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating payment: " . $stmt->error;
    }
}
?>
