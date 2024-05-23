<?php
include('dbconnection.php');

if(isset($_REQUEST['WorkshopID'])) {
    $WorkshopID = $_REQUEST['WorkshopID'];
    
    // Prepare and execute SELECT statement to retrieve attendee details
    $stmt = $connection->prepare("SELECT * FROM workshops WHERE WorkshopID = ?");
    $stmt->bind_param("i", $WorkshopID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['WorkshopID'];
        $z = $row['Title'];
        $y = $row['Duration'];
        $e = $row['InstructorID'];
        $f = $row['Location'];
    } else {
        echo "Workshop not found.";
    }
}

?>

<html>
<head>
    <title>Update workshop</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="WorkshopID">WorkshopID:</label>
        <input type="number" name="WorkshopID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>

        <label for="Title">Title:</label>
        <input type="text" name="Title" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="Duration">Duration:</label>
        <input type="text" name="Duration" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="InstructorID">InstructorID:</label>
        <input type="number" name="InstructorID" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="Location">Location:</label>
        <input type="text" name="Location" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>
        
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $WorkshopID = $_POST['WorkshopID'];
    $Title = $_POST['Title'];
    $Duration = $_POST['Duration'];
    $InstructorID = $_POST['InstructorID'];
    $Location = $_POST['Location'];
    
    // Update the workshop in the database
    $stmt = $connection->prepare("UPDATE workshops SET Title=?, Duration=?, InstructorID=?, Location=? WHERE WorkshopID=?");
    $stmt->bind_param("ssisi", $Title, $Duration, $InstructorID, $Location, $WorkshopID);
    
    if ($stmt->execute()) {
        // Redirect to view page after successful update
        header('Location: workshops_view.php');
        exit(); //
    } else {
        echo "Error updating Workshop: " . $stmt->error;
    }
}
?>
