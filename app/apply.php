<?php
$servername="localhost";
$username="root";
$password="";
$dbname = "RMS";

$conn=new mysqli($servername,$username,$password, $dbname);
if($conn->connect_error)
{
    die("error connecting".$conn->connect_error);
}

$username = $_POST['username'];
$jobname = $_POST['jobname'];
$company= $_POST['company'];

$sql = "INSERT INTO `$jobname` (username) VALUES ('$username')";
if($conn->query($sql) === TRUE) {
    echo "Applied for job successfully.";
} else {
    echo "Error applying for job: " . $conn->error;
}
$sql = "INSERT INTO `$username` (jobname,company) VALUES ('$jobname', '$company')";
if($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error applying for job: " . $conn->error;
}
?>
