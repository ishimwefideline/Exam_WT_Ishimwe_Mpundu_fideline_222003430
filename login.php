<?php
session_start(); // Start the session

include('dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT UserID, Password FROM users WHERE Email=?";
    $stmt = $connection->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }

    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($Password, $row['Password'])) {
            $_SESSION['UserID'] = $row['UserID']; // Fix: Use correct column name
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "User not found";
    }
}

$connection->close();
?>
