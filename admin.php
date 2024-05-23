<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Career Development Workshop Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border: 2px solid red;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h3 {
            color: deeppink;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
        }
        table tr {
            margin-bottom: 20px;
        }
        table tr td {
            padding: 10px;
        }
        table tr td:first-child {
            text-align: right;
            padding-right: 20px;
            font-size: 16px;
            color: deeppink;
        }
        table tr td:last-child {
            text-align: left;
        }
        input[type="number"],
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"],
        input[type="reset"] {
            width: calc(50% - 10px);
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: violet;
            color: white;
            cursor: pointer;
            margin-top: 20px;
        }
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: darkviolet;
        }
        footer {
            background-color: hotpink;
            text-align: center;
            padding: 10px 0;
            color: white;
            font-size: 18px;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>
<body>
<div class="form-container">
    <form action="" method="POST">
        <h3>ADMIN FORM</h3>
        <table>
            <tr>
                <td>Id:</td>
                <td><input type="number" name="id" required></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="psword" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" name="send" value="Send">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
    </form>

    <?php
    // Connection details
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "career_development";
    $connection = new mysqli($host, $user, $pass, $database);

    // Checking connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Inserting data into the database
    if (isset($_POST['send'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
         $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO admin (id, username, password) VALUES ('$id', '$username', '$password')";

        if ($connection->query($sql) === TRUE) {
            echo "Data inserted successfully<br>";
            header("location:admin.php");
        } else {
            echo "Error inserting data: " . $connection->error;
        }
    }

    // Closing connection
    $connection->close();
    ?>
</div>

<footer>
    <p>Designed by Fideline Mpundu Ishimwe_222003430 &copy; YEAR TWO BIT GROUP A &reg; 2024</p>
</footer>
</body>
</html>
