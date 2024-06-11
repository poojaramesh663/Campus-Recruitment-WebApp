<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        div {
            padding: 20px;
            text-align: center;
            border-style: solid;
            border-width: 1px;
            margin-left: 250px;
            margin-right: 250px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="file"] {
            width: 300px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
		button {
            background-color: #007bff;
            color: white;
            border: none;
			margin:5px;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
		button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
	
    <button ><a href="recruiter.php" style="text-decoration:none;color:white;">Back</a></button>
    
    
	<div>
	<h1>LIST YOUR JOB</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input placeholder="Job Name" type="text" name="jn" required><br>
            <input type="text"  placeholder="Job summary" name="js" required><br>
            <input type="text" name="jr"  placeholder="Requirements" required><br>
            <input type="text" name="ee"  placeholder="Experience and Education" required><br>
            <input type="text" name="jl"  placeholder="Job Location" required><br>
            <input type="text" name="cn"  placeholder="Company Name" required><br>
            <label>Upload Image:</label>
            <input type="file" name="image"  placeholder="" required><br>
            <input type="text" name="un"  placeholder="Re enter your Username" required><br><br>
            <input type="submit" name="submit" value="List Your Job" ><br><br>
        </form>
    </div>
</body>

</html>


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
	echo"";
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

$sql="CREATE TABLE IF NOT EXISTS JOBDETAILS(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,jname VARCHAR(20),jsummary VARCHAR(100),jreq VARCHAR(100),expandedu VARCHAR(100),jloc VARCHAR(30),cname VARCHAR(30),uname VARCHAR(30), image VARCHAR(255))";
if($conn->query($sql)===TRUE)
{
	echo"";
		
}
else
{
	echo"error".$conn->error."<br>";
	
}
if(isset($_POST['submit']))
{
	$a=$_POST['jn'];
	$c=$_POST['js'];
	$b=$_POST['jr'];
	$d=$_POST['ee'];
    $e=$_POST['jl'];
    $f=$_POST['cn'];
	$g=$_POST['un'];
 // File upload handling
 $target_dir = "uploads/"; // Directory where images will be stored
 $target_file = $target_dir . basename($_FILES["image"]["name"]); // Path of the uploaded file
 move_uploaded_file($_FILES["image"]["tmp_name"], $target_file); // Move the uploaded file to the target directory

 // Store image path along with job details in the database
 $sql = "INSERT INTO JOBDETAILS(jname,jsummary,jreq,expandedu,jloc,cname,uname,image) VALUES('$a','$c','$b','$d','$e','$f','$g','$target_file')";
if($conn->query($sql)===TRUE)
{
	echo"new job listed<br>";
		
}
else
{
	echo"error".$conn->error."<br>";
	
}
$sql2="CREATE TABLE IF NOT EXISTS `$a`(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username VARCHAR(20))";
if($conn->query($sql2)===TRUE)
{
	echo"";
		
}
else
{
	echo"error".$conn->error."<br>";
	
}

}
	
	
?>