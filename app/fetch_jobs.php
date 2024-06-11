<html>
    <head>
        <style>table {
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

img {
    max-width: 100px;
    max-height: 100px;
}

h5 {
    margin-bottom: 5px;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
    color: #0056b3;
}
</style>
    </head>
</html>

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
$username = $_POST['username'];

// Query database for job details for the specified user
$sql = "SELECT * FROM JOBDETAILS WHERE uname = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo"<td><img src='" . $row['image'] . "' alt='Job Image' style='width: 100px; height: 100px;'></td>";
        echo "<td>" . $row['jname'] . "</td>";
        echo "<td>" . $row['jsummary'] . "</td>";
        $jobname = $row['jname'];
        
        // Query database for applied users for this job
        $sql1 = "SELECT * FROM `$jobname`";
        $result1 = $conn->query($sql1);
        
        if ($result1->num_rows > 0) {
            echo "<td><h5>Applied Users:</h5><table border='1'>";
            while ($row1 = $result1->fetch_assoc()) {
                echo "<tr>";
                $applied_username = $row1['username']; // Different variable for user's username
                // echo "<td>" . $applied_username . "</td>";
                
                // Query database for applied user's details
                $sql2 = "SELECT * FROM USERS WHERE username = '$applied_username'";
                $result2 = $conn->query($sql2);
                
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        
                        echo "<td>" . $row2['name'] . "</td>";
                        echo "<td>" . $row2['age'] . "</td>";
                        echo "<td>" . $row2['address'] . "</td>";
                        echo "<td>" . $row2['skills'] . "</td>";
                        echo "<td>" . $row2['languages'] . "</td>";
                        // Display link to the resume
                        echo "<td><a href='" . $row2['resume'] . "' target='_blank'>View Resume</a></td>";
                        echo "<td><a href='mailto:" . $row2['email'] . "'>Contact</a></td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table></td>";
        } else {
            echo "<td>No applied users yet.</td>";
        }
        
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No listings for now!";
}

$conn->close();
?>
