<?php
include('dbconnection.php');

if(isset($_REQUEST['EnrollmentID'])) {
    $EnrollmentID = $_REQUEST['EnrollmentID'];
    
    // Prepare and execute SELECT statement to retrieve attendee details
    $stmt = $connection->prepare("SELECT * FROM enrollments WHERE EnrollmentID = ?");
    $stmt->bind_param("i", $EnrollmentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['EnrollmentID'];
        $z = $row['AttendeeID'];
        $y = $row['WorkshopID'];
        $e = $row['EnrollmentDate'];
       
    } else {
        echo "enrollments not found.";
    }
}

?>

<html>
<head>
    <title>Update enrollments</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="EnrollmentID">EnrollmentID:</label>
        <input type="number" name="EnrollmentID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>

        <label for="AttendeeID">AttendeeID:</label>
        <input type="number" name="AttendeeID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="WorkshopID">WorkshopID:</label>
        <input type="number" name="WorkshopID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="EnrollmentDate">EnrollmentDate:</label>
        <input type="date" name="EnrollmentDate" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

       
        
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $EnrollmentID = $_POST['EnrollmentID'];
    $AttendeeID = $_POST['AttendeeID'];
    $WorkshopID = $_POST['WorkshopID'];
    $EnrollmentDate = $_POST['EnrollmentDate'];
     
    
    // Update the attendee in the database
    $stmt = $connection->prepare("UPDATE enrollments SET AttendeeID=?, WorkshopID=?, EnrollmentDate=? WHERE EnrollmentID=?");
    $stmt->bind_param("isss", $AttendeeID, $WorkshopID, $EnrollmentDate,  $WorkshopID);
    
    if ($stmt->execute()) {
        // Redirect to view page after successful update
        header('Location:enrollments_view.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating enrollments: " . $stmt->error;
    }
}
?>
