<?php
include('dbconnection.php');

if(isset($_REQUEST['AttendeeID'])) {
    $AttendeeID = $_REQUEST['AttendeeID'];
    
    // Prepare and execute SELECT statement to retrieve attendee details
    $stmt = $connection->prepare("SELECT * FROM Attendees WHERE AttendeeID = ?");
    $stmt->bind_param("i", $AttendeeID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['AttendeeID'];
        $z = $row['UserID'];
        $y = $row['Fullname'];
        $e = $row['Email'];
    } else {
        echo "Attendee not found.";
    }
}

?>

<html>
<head>
    <title>Update Attendee</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="AttendeeID">AttendeeID:</label>
        <input type="number" name="AttendeeID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="Fullname">Fullname:</label>
        <input type="text" name="Fullname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $AttendeeID = $_POST['AttendeeID'];
    $UserID = $_POST['UserID'];
    $Fullname = $_POST['Fullname'];
    $Email = $_POST['Email'];
    
    // Update the attendee in the database
    $stmt = $connection->prepare("UPDATE Attendees SET UserID=?, Fullname=?, Email=? WHERE AttendeeID=?");
    $stmt->bind_param("isss", $UserID, $Fullname, $Email, $AttendeeID);
    
    if ($stmt->execute()) {
        // Redirect to view page after successful update
        header('Location: Attendees_view.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating attendee: " . $stmt->error;
    }
}
?>
