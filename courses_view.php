<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 1200px;
            margin: 50px auto;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        th, td {
            border: 1px solid #000;
            padding: 0px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;

        }

        .btn-delete, .btn-update {
            display: inline-block;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            margin:10px;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-update {
            background-color: #28a745;
        }
        footer {
            background-color:teal;
            text-align: center;
            width: 100%;
            height: 70px;
            color: white;
            font-size: 25px;
            position: fixed;
            bottom: 0;
            left: 0;
    </style>
</head>
<body>
    <div class="container">
        <h1>List Of Courses</h1>
        <table>
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Instructor ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <body>
                <?php
                include('dbconnection.php');
                // Check connection
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["CourseID"]."</td>";
                        echo "<td>".$row["CourseName"]."</td>";
                        echo "<td>".$row["Description"]."</td>";
                        echo "<td>".$row["InstructorID"]."</td>";
                        echo "<td>".$row["StartDate"]."</td>";
                        echo "<td>".$row["EndDate"]."</td>";
                        echo "<td>".$row["Duration"]."</td>";
                        echo "<td>".$row["Price"]."</td>";
                        echo "<td>";
                        echo "<a href='update_courses.php?CourseID=".$row["CourseID"]."' class='btn-update'>Update</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='delete_courses.php?CourseID=".$row["CourseID"]."' class='btn-delete'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No courses found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>