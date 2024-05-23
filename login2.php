<?php
session_start();

include('dbconnection.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $em = $_POST['username'];
    $pass = $_POST['password'];

    // Using prepared statements to avoid SQL injection
    $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $em, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $em; // Fixing the variable name here
        header("Location: admin_dashboard.html");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}

$connection->close();
?>
