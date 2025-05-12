<?php
// Display errors for debugging 
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $persons = htmlspecialchars(trim($_POST['persons']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $comments = htmlspecialchars(trim($_POST['comments']));

    // Phone format
    if (!preg_match('/^\(\d{3}\)\s\d{3}-\d{4}$/', $phone)) {
        die("Invalid phone format. Use (123) 456-7890.");
    }

    // Date validation
    $today = date("Y-m-d");
    $oneMonthLater = date("Y-m-d", strtotime("+1 month"));
    if ($date < $today || $date > $oneMonthLater) {
        die("Reservation date must be within 1 month from today.");
    }

    // Comment word limit
    if (str_word_count($comments) > 50) {
        die("Comments cannot exceed 50 words.");
    }

    // Connect to MySQL (without DB first) 
    $conn = mysqli_connect("localhost", "root", "Shumaila2019!");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create DB if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS php_db";
    if (!mysqli_query($conn, $sql)) {
        die("Error creating database: " . mysqli_error($conn));
    }

    // Select DB
    mysqli_select_db($conn, "php_db");

    // Create table if not exists
    $tableSql = "CREATE TABLE IF NOT EXISTS reservations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        persons INT NOT NULL,
        date DATE NOT NULL,
        time VARCHAR(10) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        comments TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if (!mysqli_query($conn, $tableSql)) {
        die("Error creating table: " . mysqli_error($conn));
    }

    // Check overbooking
    $checkSql = "SELECT COUNT(*) AS count FROM reservations WHERE date = '$date' AND time = '$time'";
    $result = mysqli_query($conn, $checkSql);
    $row = mysqli_fetch_assoc($result);
    if ($row['count'] >= 10) {
        die("This time slot is fully booked. Please select a different time.");
    }

    // Insert reservation
    $insertSql = "INSERT INTO reservations (persons, date, time, phone, comments)
                  VALUES ('$persons', '$date', '$time', '$phone', '$comments')";
    if (mysqli_query($conn, $insertSql)) {
        echo "<h1>Reservation Successful!</h1>";
        echo "<p>Thank you for booking with us.</p>";
        echo "<a href='Reservations.php'>Make another reservation</a>";
    } else {
        echo "<h1>Error</h1><p>Failed to save reservation: " . mysqli_error($conn) . "</p>";
    }

    // Close connection
    mysqli_close($conn);
}
?>
