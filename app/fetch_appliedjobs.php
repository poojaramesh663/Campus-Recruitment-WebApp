<html>
    <head><style>table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style></head></html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "RMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username from AJAX request
$usernamee = $_POST['username'];

// Sanitize the username to prevent SQL injection
$usernamee = $conn->real_escape_string($usernamee);

// Query database for applied job details for the specified user
$sql = "SELECT * FROM `$usernamee`"; // Use backticks to specify the table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Applied Jobs</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['jobname'] . "   from   " . $row['company'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No applied jobs for now!";
}

$conn->close();
?>
