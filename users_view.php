<?php
include('dbconnection.php');

$sql = "SELECT * FROM users";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Information of users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"] {
            padding: 6px;
        }

        button[type="submit"] {
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        button.delete, button.update {
            padding: 6px 12px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            border-radius: 4px;
        }

        button.update {
            background-color: #008CBA;
        }

        footer {
            background-color: grey;
            text-align: center;
            color: white;
            font-size: 16px;
            height: 70px;
            line-height: 70px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <center>
        
        <h2>Table of users</h2>
    </center>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>UserType</th>
           
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $UserID = $row['UserID'];
                echo "<tr>
                    <td>" . $row['UserID'] . "</td>
                    <td>" . $row['Username'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td>" . $row['Password'] . "</td>
                    <td>" . $row['UserType'] . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        $connection->close();
        ?>
    </table>
    <footer>
        <p>Designed by Fideline ISHIMWE_Mpundu_222003430 &copy; YEAR TWO BIT GROUP A &reg; 2024</p>
    </footer>
    <center>
        <button style="background-color: darkgreen; width: 150px;height: 40px;">
            <a href="home.html" style="font-size: 15px;color: white;text-decoration: none;">Back Home</a>
        </button>
    </center>
</body>
</html>
