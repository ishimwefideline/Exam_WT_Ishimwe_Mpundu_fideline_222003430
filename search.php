<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Connection details with single file
    $host = "localhost";
$user = "root";
$pass = "";
$database = "career_development";
$connection = new mysqli($host, $user, $pass, $database);
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'attendees' => "SELECT * FROM attendees WHERE AttendeeID LIKE '%$searchTerm%'",
        'categories' => "SELECT * FROM categories WHERE CategoryName LIKE '%$searchTerm%'",
        'enrollments' => "SELECT * FROM enrollments WHERE EnrollmentID LIKE '%$searchTerm%'",
        'instructors' => "SELECT * FROM instructors WHERE InstructorID LIKE '%$searchTerm%'",
        'notifications' => "SELECT * FROM notifications WHERE NotificationID LIKE '%$searchTerm%'",
        'payments' => "SELECT * FROM payments WHERE PaymentID LIKE '%$searchTerm%'",
        'resources' => "SELECT * FROM resources WHERE ResourceID LIKE '%$searchTerm%'",
        'reviews' => "SELECT * FROM reviews WHERE ReviewID LIKE '%$searchTerm%'",
        'workshops' => "SELECT * FROM workshops WHERE WorkshopID LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
