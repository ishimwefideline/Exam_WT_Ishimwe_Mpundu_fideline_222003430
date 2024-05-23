<?php
include('dbconnection.php');
if(isset($_REQUEST['CategoryID'])) {
    $CategoryID = $_REQUEST['CategoryID'];
    
    // Prepare and execute SELECT statement to retrieve category details
    $stmt = $connection->prepare("SELECT * FROM categories WHERE CategoryID = ?");
    $stmt->bind_param("i", $CategoryID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['CategoryID'];
        $z = $row['CategoryName'];
        $y = $row['Description'];
       
    } else {
        echo "Category not found.";
    }
}

?>

<html>
<head>
    <title>Update categories</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="CategoryID">CategoryID:</label>
        <input type="number" name="CategoryID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>

        <label for="CategoryName">CategoryName:</label>
        <input type="text" name="CategoryName" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];
    $Description = $_POST['Description'];
    
    // Update the category in the database
    $stmt = $connection->prepare("UPDATE categories SET CategoryName=?, Description=? WHERE CategoryID=?");
    $stmt->bind_param("ssi", $CategoryName, $Description, $CategoryID);
    
    if ($stmt->execute()) {
        // Redirect to view page after successful update
        header('Location: categories_view.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating category: " . $stmt->error;
    }
}
?>
