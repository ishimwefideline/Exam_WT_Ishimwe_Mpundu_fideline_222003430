<?php
include 'dbconnection.php';

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $UserID  = $_POST['UserID'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email']; // Fix: Correct variable name
    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $UserType = $_POST['UserType'];
    
    // Preparing SQL query
    $sql = "INSERT INTO users (UserID, Username, Email, Password, UserType) VALUES ('$UserID','$Username','$Email', '$Password','$UserType')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) { // Fix: Change $conn to $connection
        // Redirecting to login page on successful registration
        header("Location: login.html");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error; // Fix: Change $connect to $connection
    }
}

// Closing database connection
$connection->close(); // Fix: Change $conn to $connection
?>
