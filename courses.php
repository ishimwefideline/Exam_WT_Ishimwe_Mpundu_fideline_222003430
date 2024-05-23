<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('./img.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 2px black;
            background-color: grey;
            border-radius: 10px;
        }

        .heading {
            text-align: center;
            font-weight: bold;
            font-size: 25px;
            color: blue;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 20px;
            color: black;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"],
        input[type="date"],
        input[type="email"] {
            width: calc(100% - 10px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"],
        input[type="button"] {
            width: 48%;
            padding: 10px;
            font-size: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color:#dc3545;
            color: white;
        }

        input[type="button"] {
            background-color: #007bff;
            color: white;
        }

        input[type="submit"]:last-child {
            background-color: blue;
            margin-left: 4%;
        }
    </style>
    <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body>
<h2 class="heading"><i>ONLINE CAREER DEVELOPMENT WORKSHOP PLATFORM</i></h2>
<div class="container">
    <h2 class="heading"><i>Course Form</i></h2>
    <form action="" method="POST" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="cname">Course Name</label>
            <input type="text" name="course" id="cname" required>
        </div>
        <div class="form-group">
            <label for="des">Description</label>
            <input type="text" name="des" id="des" required>
        </div>
        <div class="form-group">
            <label for="id">Instructor Id</label>
            <input type="number" name="id" id="id" required>
        </div>
        <div class="form-group">
            <label for="sdate">Start Date</label>
            <input type="date" name="sdate" id="sdate" required>
        </div>
        <div class="form-group">
            <label for="edate">End Date</label>
            <input type="date" name="edate" id="edate" required>
        </div>
        <div class="form-group">
            <label for="duration">Duration</label>
            <input type="number" name="duration" id="duration" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" required>
        </div>
        <input type="submit" name="send" value="Send">
        <input type="button" value="Cancel" onclick="window.location.href=''">
    </form>
</div>
<?php
include('dbconnection.php');

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if(isset($_POST['send'])) {
    // Retrieve values from form
    $courseName = $_POST['course'];
    $description = $_POST['des'];
    $instructorID = $_POST['id'];
    $startDate = $_POST['sdate'];
    $endDate = $_POST['edate'];
    $duration = $_POST['duration']; 
    $price = $_POST['price']; 

    // Insert new record into the database
    $sql = "INSERT INTO courses (CourseName, Description, InstructorID, StartDate, EndDate, Duration, Price) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssss", $courseName, $description, $instructorID, $startDate, $endDate, $duration, $price);

    if ($stmt->execute()) {
        // Redirect to a success page
         echo "<script>alert('course added successful.'); window.location.href = '#?id=$userID';</script>";
        exit();
    } else {
        echo "Error inserting record: " . $stmt->error;
    }
}
?>
<footer>
    <center>
    <p>Designed by ishimwe mpundu fideline_222003430 &copy; YEAR TWO BIT GROUP A &reg; 2024</p>
    </center>
</footer>
</body>
</html>
