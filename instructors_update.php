<?php
include('dbconnection.php');

if(isset($_REQUEST['InstructorID'])) {
    $InstructorID = $_REQUEST['InstructorID'];
    
    // Prepare and execute SELECT statement to retrieve attendee details
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE InstructorID = ?");
    $stmt->bind_param("i", $InstructorID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['InstructorID'];
        $z = $row['UserID'];
        $y = $row['Fullname'];
        $e = $row['Specialization'];
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
        <label for="InstructorID">InstructorID:</label>
        <input type="number" name="InstructorID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>

        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="Fullname">Fullname:</label>
        <input type="text" name="Fullname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="Specialization">Specialization:</label>
        <input type="text" name="Specialization" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $InstructorID = $_POST['InstructorID'];
    $UserID = $_POST['UserID'];
    $Fullname = $_POST['Fullname'];
    $Specialization = $_POST['Specialization'];
    
    // Update the instructor in the database
    $stmt = $connection->prepare("UPDATE instructors SET UserID=?, Fullname=?, Specialization=? WHERE InstructorID=?");
    $stmt->bind_param("isss", $UserID, $Fullname, $Specialization, $InstructorID);
    
    if ($stmt->execute()) {
        // Redirect to view page after successful update
        header('Location: instructors_view.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating instructors: " . $stmt->error;
    }
}
?>
