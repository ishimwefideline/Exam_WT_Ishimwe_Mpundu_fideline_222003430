<?php
session_start();

include('dbconnection.php');

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $em = $_POST['username'];
    $password = $_POST['password'];

    // Using prepared statements to avoid SQL injection
    $sql = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $sql->bind_param("ss", $em, $password);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];  // Assuming the table has a 'username' column

        // Debugging: Check if session username is set
        echo "Session Username: " . $_SESSION['username'] . "<br>";

        header("Location: admin_dashboard.html");
        exit(); // Ensure no further code execution after redirect
    } else {
        $error = "Invalid username or password";
    }

    $sql->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input[type="username"],
        .login-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container button {
            background-color: teal;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .login-container button:hover {
            background-color: darkcyan;
        }
        .login-container .secondary-btn {
            background-color: gray;
            margin-top: 10px;
        }
        .login-container .secondary-btn:hover {
            background-color: darkgray;
        }
        .login-container .create-account-btn {
            background-color: deeppink;
            margin-top: 10px;
        }
        .login-container .create-account-btn:hover {
            background-color: darkmagenta;
        }
        .login-container p.error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login admin </h2>
        <form method="post" action="">
            <input type="username" name="username" placeholder="username" required><br>
            <input type="password" name="password" placeholder="password" required><br>
            <button type="submit">Login</button>
            <button type="reset" class="secondary-btn">Cancel</button>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
