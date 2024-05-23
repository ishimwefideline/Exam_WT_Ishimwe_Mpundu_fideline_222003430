<?php
include('dbconnection.php');
if(isset($_REQUEST['ReviewID'])) {
    $ReviewID = $_REQUEST['ReviewID'];
    
    // Prepare and execute SELECT statement to retrieve attendee details
    $stmt = $connection->prepare("SELECT * FROM reviews WHERE ReviewID = ?");
    $stmt->bind_param("i", $ReviewID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ReviewID'];
        $z = $row['WorkshopID'];
        $y = $row['AttendeeID'];
        $e = $row['Comment'];
        $f = $row['ReviewDate'];
    } else {
        echo "workshop not found.";
    }
}

?>

<html>
<head>
    <title>Update review</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="ReviewID">ReviewID:</label>
        <input type="number" name="ReviewID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>

        <label for="WorkshopID">WorkshopID:</label>
        <input type="number" name="WorkshopID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="AttendeeID">AttendeeID:</label>
        <input type="number" name="AttendeeID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="Comment">Comment:</label>
        <input type="text" name="Comment" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="ReviewDate">ReviewDate:</label>
        <input type="date" name="ReviewDate" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>
        
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $ReviewID = $_POST['ReviewID'];
    $WorkshopID = $_POST['WorkshopID'];
    $AttendeeID = $_POST['AttendeeID'];
    $Comment = $_POST['Comment'];
      $ReviewDate = $_POST['ReviewDate'];
    
    // Update the attendee in the database
    $stmt = $connection->prepare("UPDATE reviews SET WorkshopID=?, AttendeeID=?, Comment=?, ReviewDate=? WHERE ReviewID=?");
    $stmt->bind_param("issss", $WorkshopID, $AttendeeID, $Comment, $ReviewDate,  $ReviewID);
    
    if ($stmt->execute()) {
        // Redirect to view page after successful update
        header('Location: reviews_view.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating reviews: " . $stmt->error;
    }
}
?>
