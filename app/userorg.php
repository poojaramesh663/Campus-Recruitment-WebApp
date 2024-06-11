<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #322C2B;
        }
        .logout-button {
            background-color: #ff0000; /* Red color for logout button */
            color: white;
            padding: 2px 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 25px;
            margin-bottom: 10px;
            margin-left: 1370px; /* Adjust margin-left for positioning */
        }
        .logout-button:hover {
            background-color: #cc0000; /* Darker shade of red on hover */
        }
        table {
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
            background-color: #803D3B;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div style="display:flex; background-color:#E4C59E; padding:5px">
    <h2 style="color:#322C2B;margin-left:10px;">ADMIN PANEL</h2>
    <button class="logout-button"><a href="home.html" style="text-decoration:none; color:white">LOGOUT</a></button>
    </div>
    <?php
    $servername="localhost";
    $username="root";
    $password="";

    $conn=new mysqli($servername,$username,$password);
    if($conn->connect_error)
    {
        die("error connecting".$conn->connect_error);
    }
    else
    {
    }
    $sql="CREATE DATABASE IF NOT EXISTS RMS";
    if($conn->query($sql)===TRUE)
    {
        echo"";
    }
    else
    {
        echo"error".$conn->error."<br>";
    }
    mysqli_select_db($conn,"RMS");

    $sql="SELECT * FROM JOBDETAILS";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
        echo "
        <h1>JOB LISTINGS</h1>
        <div STYLE=\"padding:20px;align:center;\">
        <table border='1' STYLE=\"padding:2px;text-align:center;\" >
        <tr>
        <th STYLE=\"padding:3px\">JOB NAME</th>
        <th STYLE=\"padding:3px\">SUMMARY</th>
        <th STYLE=\"padding:3px\">REQUIREMENTS</th>
        <th STYLE=\"padding:3px\">EDUCATION AND EXPERIENCE</th>
        <th STYLE=\"padding:3px\">LOCATION</th>
        <th STYLE=\"padding:3px\">COMPANY NAME</th>
        </tr>";
        while($row=$result->fetch_assoc())
        {
            echo"<tr>
            <td STYLE=\"padding:3px\">".$row['jname']."</td>    
            <td STYLE=\"padding:7px\">".$row['jsummary']."</td>
            <td STYLE=\"padding:5px\">".$row['jreq']."</td>
            <td STYLE=\"padding:7px\">".$row['expandedu']."</td>    
            <td STYLE=\"padding:3px\">".$row['jloc']."</td>
            <td STYLE=\"padding:3px\">".$row['cname']."</td>
            </tr>";
        }
        echo"</table></div>";
    }
    else 
    {
        echo"no listings for now!";
    }

    // Check if form is submitted to remove a user
    foreach($_POST as $key => $value) {
        if(strpos($key, 'remove_user_') !== false) { // Check if the form submission is for removing a user
            $user_id = substr($key, strlen('remove_user_')); // Extract the recruiter ID from the form submission key
            // Perform the removal operation for the recruiter with this ID
            $sql = "DELETE FROM USERS WHERE ID = '$user_id'";
            if($conn->query($sql) === TRUE) {
                echo "User removed successfully.";
                // Redirect or update page as needed
            } else {
                echo "Error removing user: " . $conn->error;
            }
        }
    }

    // Fetch users from the database
    $sql="SELECT ID, Username FROM USERS";
    $result=$conn->query($sql);
    if($result->num_rows>0) {
        echo "
        <div STYLE=\"padding:20px;align:center;\">
        <h1>USERS</h1>";
        while($row=$result->fetch_assoc()) {
            echo "<form method=\"post\"> <!-- Each user is inside a separate form -->
            <table border='1' STYLE=\"padding:2px;text-align:center;\" >
            <tr>
            <th STYLE=\"padding:3px\">USER NAME</th>
            <th STYLE=\"padding:3px\">REMOVE USER</th>
            </tr>
            <tr>
            <td STYLE=\"padding:3px\">".$row['Username']."</td>   
            <td STYLE=\"padding:5px\">
            <input type=\"hidden\" name=\"user_username\" value=\"".$row['Username']."\"> <!-- Hidden input to pass user username -->
            <input type=\"submit\" name=\"remove_user_".$row['ID']."\" value=\"REMOVE USER\"> <!-- Unique submit button -->
            </td>
            </tr>
            </table></form>";
        }
        echo "</div>";
    } else {
        echo "No users found!";
    }

    $sql = "SELECT ID, Username FROM RECRUITERS";
    $result=$conn->query($sql);
    if($result->num_rows > 0) {
        echo "
        <div STYLE=\"padding:20px;align:center;\">
        <h1>RECRUITERS</h1>";
        while($row=$result->fetch_assoc()) {
            echo "<form method=\"post\"> <!-- Each recruiter is inside a separate form -->
            <table border='1' STYLE=\"padding:2px;text-align:center;\" >
            <tr>
            <th STYLE=\"padding:3px\">RECRUITER/COMPANY NAME</th>
            <th STYLE=\"padding:3px\">REMOVE RECRUITER/COMPANY</th>
            </tr>
            <tr>
            <td STYLE=\"padding:3px\">".$row['Username']."</td>   
            <td STYLE=\"padding:5px\">
            <input type=\"hidden\" name=\"recruiter_username\" value=\"".$row['Username']."\"> <!-- Hidden input to pass recruiter username -->
            <input type=\"submit\" name=\"remove_recruiter_".$row['ID']."\" value=\"REMOVE RECRUITER\"> <!-- Unique submit button -->
            </td>
            </tr>
            </table></form>";
        }
        echo "</div>";
    } else {
        echo "No recruiters found!";
    }

    // Check if form is submitted to remove a recruiter
    foreach($_POST as $key => $value) {
        if(strpos($key, 'remove_recruiter_') !== false) { // Check if the form submission is for removing a recruiter
            $recruiter_id = substr($key, strlen('remove_recruiter_')); // Extract the recruiter ID from the form submission key
            // Perform the removal operation for the recruiter with this ID
            $sql = "DELETE FROM RECRUITERS WHERE ID = '$recruiter_id'";
            if($conn->query($sql) === TRUE) {
                echo "Recruiter removed successfully.";
                // Redirect or update page as needed
            } else {
                echo "Error removing recruiter: " . $conn->error;
            }
        }
    }
    ?>
</body>
</html>
