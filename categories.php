<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Career Development Workshop Platform </title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('./tth.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Header styling */
        .header {
            display: flex;
            margin: 20px;
            align-items: center;
            padding: 10px 20px;
            background-color: teal;
            border-bottom: 5px solid black;
        }
        .logo {
            width: 60px;
            height: auto;
        }
        .header h3 {
            color: white;
        }
        .navigation {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .navigation li {
            display: inline-block;
            margin-right: 10px;
        }
        .navigation li a {
            text-decoration: none;
            color: white;
            background-color: none;
            padding: 8px 15px;
            border-radius: 3px;
        }
        .navigation li a:hover {
            background-color: deeppink;
        }

        /* Main content styling */
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Adding opacity to background */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            color: darkolivegreen;
        }
        .container p {
            color: #333;
        }

        /* Footer styling */
        footer {
            background-color: teal;
            text-align: center;
            width: 100%;
            height: 70px;
            color: white;
            font-size: 25px;
            position: fixed;
            bottom: 0;
            left: 0;
        }

        /* Dropdown styles */
        .dropdown-contents {
            display: none;
            position: absolute;
            background-color: deeppink;
            text-decoration: none;
            min-width: 120px;
            z-index: 1;
        }
        .dropdown-contents a {
            color: black;
            text-decoration: none;
            display: block;
            padding: 10px;
        }
        .dropdown-contents a:hover {
            background-color: red;
        }
        .dropdown:hover .dropdown-contents {
            display: block;
        }
    </style>
</head>
<body>
<header>
<div class="header">
    <img class="logo" src="logo2.jpg" alt="Logo">
    <h3>ONLINE CAREER DEVELOPMENT<br> WORKSHOP PLATFORM</h3>
    <ul class="navigation">
        <li><a href="home.html">Home</a></li>
        <li><a href="about_Us.html">About Us</a></li>
        <li><a href="contact_Us.html">Contact Us</a></li>
        <li><a href="service.html">Service</a></li>
        <li class="dropdown">
            <a href="#">Forms</a>
           <div class="dropdown-contents">
                    <a href="attendees.php">Attendees</a>
                    <a href="categories.php">Categories</a>
                    <a href="enrollments.php">Enrollments</a>
                    <a href="instructors.php">Instructors</a>
                    <a href="notifications.php">Notifications</a>
                    <a href="payments.php">Payments</a>
                    <a href="resources.php">Resources</a>
                    <a href="reviews.php">Reviews</a>
                    <a href="workshops.php">Workshops</a>
                     <a href="courses.php">courses</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">View_Tables</a>
                <div class="dropdown-contents">
                    <a href="attendees_view.php">Attendees view</a>
                    <a href="categories_view.php">Categories view</a>
                    <a href="enrollments_view.php">Enrollments view</a>
                    <a href="instructors_view.php">Instructors view</a>
                    <a href="notifications_view.php">Notifications view</a>
                    <a href="payments_view.php">Payments view</a>
                    <a href="resources_view.php">Resources view</a>
                    <a href="reviews_view.php">Reviews view</a>
                    <a href="workshops_view.php">Workshops view</a>
                    <a href="courses_view.php">courses view</a>
                </div>
        </li>
        <li class="dropdown">
            <a href="#">Settings</a>
            <div class="dropdown-contents">
                <a href="login.html">Login</a>
                <a href="registration.html">Registration</a>
                <a href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</div>
</header>
<center>
<p style="font-weight: bold;font-size: 25px;align-items: center;color: blue;"><i>ONLINE CAREER DEVELOPMENT WORKSHOPS PLATFORM</i></p>
<form action="" method="POST" onsubmit="return confirmInsert();">
    <h3 style="font-size: 20px;color: deeppink;"><i>CATEGORIES FORM</i></h3>
    <label for="CategoryID">CategoryID:</label>
    <input type="number" id="CategoryID" name="CategoryID"><br><br>

    <label for="CategoryName">CategoryName:</label>
    <input type="text" id="CategoryName" name="CategoryName" required><br><br>

    <label for="Description">Description:</label>
    <input type="text" id="Description" name="Description" required><br><br>

    

   

    <input type="submit" name="send" value="Register" style="width: 150px;background-color: indigo;color: white;font-size: 30px;">
    <input type="submit" name="send" value="Cancel" style="width: 150px;background-color:blue;color: white;font-size: 30px;">
</form>

<?php
include('dbconnection.php');
if(isset($_POST['send'])) {
    // Retrieve values from form
    $AttendeeID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];
    $Description= $_POST['Description'];
  
    

    // Insert new record into the database
    $stmt = $connection->prepare("INSERT INTO categories (CategoryID, CategoryName, Description) VALUES (?, ?, ?)");

    $stmt->bind_param("iss", $CategoryID, $CategoryName, $Description);

    if ($stmt->execute()) {
        echo "<script>alert('Record inserted successfully.');</script>";
    } else {
        echo "Error inserting record: " . $stmt->error;
    }
}
?>
<footer>
    <p>Designed by Fideline mpundu ishimwe_222003430 &copy; YEAR TWO BIT GROUP A &reg; 2024</p>
</footer>
</body>
</html>
