<?php
include('dbconnection.php');
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_REQUEST['ResourceID'])) {
    $ResourceID = $_REQUEST['ResourceID'];
    
    // Prepare and execute SELECT statement to retrieve resources details
    $stmt = $connection->prepare("SELECT * FROM resources WHERE ResourceID = ?");
    $stmt->bind_param("i", $ResourceID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ResourceID'];
        $z = $row['Title'];
        $y = $row['Description'];
        $e = $row['WorkshopID'];
        $f = $row['UploadedBy'];
        $g = $row['UploadDate'];

    } else {
        echo "Resources not found.";
    }
}

?>

<html>
<head>
    <title>Update Resources</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="ResourceID">ResourceID:</label>
        <input type="number" name="ResourceID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>

        <label for="Title">Title:</label>
        <input type="text" name="Title" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="WorkshopID">WorkshopID:</label>
        <input type="number" name="WorkshopID" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="UploadedBy">UploadedBy:</label>
        <input type="text" name="UploadedBy" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>
        
        <label for="UploadDate">UploadDate:</label>
        <input type="date" name="UploadDate" value="<?php echo isset($g) ? $g : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $ResourceID = $_POST['ResourceID'];
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];
    $WorkshopID = $_POST['WorkshopID'];
    $UploadedBy = $_POST['UploadedBy'];
    $UploadDate = $_POST['UploadDate'];
    
    // Update the resource in the database
    $stmt = $connection->prepare("UPDATE resources SET Title=?, Description=?, WorkshopID=?, UploadedBy=?, UploadDate=? WHERE ResourceID=?");
    $stmt->bind_param("sssisi", $Title, $Description, $WorkshopID, $UploadedBy, $UploadDate, $ResourceID);
    
    if ($stmt->execute()) {
        // Redirect to view page after successful update
        header('Location: resources_view.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating resources: " . $stmt->error;
    }
}
?>
