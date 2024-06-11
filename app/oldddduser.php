<html>
<body>
<h1 style="text-align:center;">JOB LISTINGS</h1>
<div style="padding:20px;">
<form method="POST">
<input type="text"  name="n" placeholder="SEARCH FOR JOBS" >
<input type="submit" name="s" value="search">
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
}

mysqli_select_db($conn,"RMS");

$sql="SELECT * FROM JOBDETAILS";
$result=$conn->query($sql);
if($result->num_rows>0)
{
	echo "
	<div STYLE=\"padding:20px;align:center;\">
	<table border='1' STYLE=\"padding:2px;text-align:center;\" >
	<tr>
	<th STYLE=\"padding:3px\">JOB NAME</th>
	<th STYLE=\"padding:3px\">SUMMARY</th>
	<th STYLE=\"padding:3px\">REQUIREMENTS</th>
	<th STYLE=\"padding:3px\">EDUCATION AND EXPERIENCE</th>
	<th STYLE=\"padding:3px\">LOCATION</th>
	<th STYLE=\"padding:3px\">COMPANY NAME</th>
	<th STYLE=\"padding:3px\">APPLY FOR YOUR JOB</th>
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
<td STYLE=\"padding:5px\"><BUTTON>APPLY</BUTTON></td>
</tr>";
}
echo"</table></div>";
}

else 
{
echo"no listings for now!";
}
	if(isset($_POST['s']))
	{
		$a=$_POST['n'];
		
		
		$sql="SELECT * FROM JOBDETAILS WHERE jname LIKE '%$a%'";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
	echo"<div style=\"padding:20px;border-style:solid;\">The searched Job details are:<br>";
	$row=$result->fetch_assoc();
	echo "<h2>".$row['jname']."</h2><br>";
	echo $row['jsummary']."<br>";
	echo "Requirements: ".$row['jreq']."<br>";
	echo "Experience and Education: ".$row['expandedu']."<br>";
	echo $row['jloc']."<br>";
	echo $row['cname']."<br></div>";
	
	}
	else{
		echo"no searched jobs found for now";
	
	}
	}
	
	
	
?>

