<?php
// PHP Code to Update Data in Database
include('dbconnection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['CourseID']) && is_numeric($_GET['CourseID'])) {
    $CourseID = $_GET['CourseID'];

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the keys are set before accessing them
        $CourseName = isset($_POST['CourseName']) ? $_POST['CourseName'] : '';
        $Description = isset($_POST['Description']) ? $_POST['Description'] : '';
        $StartDate = isset($_POST['StartDate']) ? $_POST['StartDate'] : '';
        $EndDate = isset($_POST['EndDate']) ? $_POST['EndDate'] : '';
        $Duration = isset($_POST['Duration']) ? $_POST['Duration'] : '';
        $Price = isset($_POST['Price']) ? $_POST['Price'] : '';

        $sql = "UPDATE courses SET CourseName='$CourseName', Description='$Description', StartDate='$StartDate', EndDate='$EndDate', Duration='$Duration', Price='$Price' WHERE CourseID=$CourseID";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header('Location: courses_view.php');
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $sql = "SELECT * FROM courses WHERE CourseID=$CourseID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?><html><head><title>update course</title>

<style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        form {
            margin: 20px auto;
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label{
            font-size: 20px;
            color:#007bff;
            font-weight: bold;
        }

        input[type="text"], input[type="date"],textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style></head>
        <form method="post" action="" onsubmit="return confirmUpdate();">
        <center><p >update course</p></center>
            <input type="hidden" name="CourseID" value="<?php echo $row['CourseID']; ?>">
            <label for="CourseName">Course Name:</label><br>
            <input type="text" name="CourseName" value="<?php echo $row['CourseName']; ?>"><br>
            <label for="Description">Description:</label><br>
            <textarea name="Description"><?php echo $row['Description']; ?></textarea><br>
            <label for="StartDate">Start Date:</label><br>
            <input type="date" name="StartDate" value="<?php echo $row['StartDate']; ?>"><br>
            <label for="EndDate">End Date:</label><br>
            <input type="date" name="EndDate" value="<?php echo $row['EndDate']; ?>"><br>
            <label for="Duration">Duration:</label><br>
            <input type="text" name="Duration" value="<?php echo $row['Duration']; ?>"><br>
            <label for="Price">Price:</label><br>
            <input type="text" name="Price" value="<?php echo $row['Price']; ?>"><br>
            <input type="submit" value="Update course">
        </form>
<?php
    } else {
        echo "Course not found";
    }
} else {
    echo "Invalid Course ID";
}
$conn->close();
?>
