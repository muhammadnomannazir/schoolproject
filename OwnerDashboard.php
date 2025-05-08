<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<h1>Reservation Dashboard</h1>

<div class="button-group">
    <form method="GET">
        <button type="submit" name="filter" value="today">Today</button>
        <button type="submit" name="filter" value="week">This Week</button>
        <button type="submit" name="filter" value="month">This Month</button>
    </form>
</div>

<div class="date-form">
    <form method="GET">
        <label for="date">Select a Day:</label>
        <input type="date" name="specific_date" id="date" required>
        <input type="submit" value="View Reservations">
    </form>
</div>

<?php
$conn = mysqli_connect("localhost", "root", "Shumaila2019!", "php_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$filter = $_GET['filter'] ?? null;
$specific_date = $_GET['specific_date'] ?? null;

$query = "SELECT * FROM reservations";

if ($filter === "today") {
    $today = date('Y-m-d');
    $query .= " WHERE date = '$today'";
} elseif ($filter === "week") {
    $start = date('Y-m-d');
    $end = date('Y-m-d', strtotime('+7 days'));
    $query .= " WHERE date BETWEEN '$start' AND '$end'";
} elseif ($filter === "month") {
    $start = date('Y-m-d');
    $end = date('Y-m-d', strtotime('+1 month'));
    $query .= " WHERE date BETWEEN '$start' AND '$end'";
} elseif ($specific_date) {
    $query .= " WHERE date = '$specific_date'";
}

$query .= " ORDER BY date ASC, time ASC";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Time</th>
                <th>Persons</th>
                <th>Phone</th>
                <th>Comments</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['date']}</td>
                <td>{$row['time']}</td>
                <td>{$row['persons']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['comments']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No reservations found.</p>";
}

mysqli_close($conn);
?>

</body>
</html>
