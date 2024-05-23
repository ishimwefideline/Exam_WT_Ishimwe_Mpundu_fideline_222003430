<?php
include('dbconnection.php');
$connection = new mysqli($host, $user, $pass, $database);

if(isset($_REQUEST['NotificationID'])) {
    $NotificationID = $_REQUEST['NotificationID'];
    
    // Prepare and execute SELECT statement to retrieve attendee details
    $stmt = $connection->prepare("SELECT * FROM notifications WHERE NotificationID = ?");
    $stmt->bind_param("i", $NotificationID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['NotificationID'];
        $z = $row['UserID'];
        $y = $row['NotificationType'];
        $e = $row['Timestamp'];
    } else {
        echo "notifications not found.";
    }
}

?>

<html>
<head>
    <title>Update notifications</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="NotificationID">NotificationID:</label>
        <input type="number" name="NotificationID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="NotificationType">NotificationType:</label>
        <input type="text" name="NotificationType" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="Timestamp">Timestamp:</label>
        <input type="time" name="Timestamp" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $NotificationID = $_POST['NotificationID'];
    $UserID = $_POST['UserID'];
    $NotificationType = $_POST['NotificationType'];
    $Timestamp = $_POST['Timestamp'];
    
    // Update the attendee in the database
    $stmt = $connection->prepare("UPDATE notifications SET UserID=?, NotificationType=?, Timestamp=? WHERE NotificationID=?");
    $stmt->bind_param("isss", $UserID, $NotificationType, $Timestamp, $NotificationID);
    
    if ($stmt->execute()) {
        // Redirect to view page after successful update
        header('Location: notifications_view.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating notifications: " . $stmt->error;
    }
}
?>
