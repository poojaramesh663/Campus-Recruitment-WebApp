<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
            .SearchBar {
            text-align: center; /* Align the content to the center */
            padding: 10px; /* Adjust padding */
            margin-top: 20px; /* Add some space on top */
            margin-bottom: 20px; /* Add some space on bottom */
            border: 1px solid #ccc; /* Add a border */
            border-radius: 5px; /* Add border radius for rounded corners */
            background-color: #f9f9f9; /* Background color */
        }

        /* Style for the search input field */
        .SearchBar input[type="text"] {
            width: 200px; /* Adjust the width */
            padding: 8px; /* Adjust padding */
            margin-right: 10px; /* Add some space on the right */
            border: 1px solid #ccc; /* Add border */
            border-radius: 5px; /* Add border radius */
        }

        /* Style for the search button */
        .SearchBar input[type="submit"] {
            background-color: #007bff; /* Button background color */
            color: white; /* Button text color */
            border: none; /* Remove border */
            padding: 8px 20px; /* Adjust padding */
            cursor: pointer; /* Change cursor to pointer */
            border-radius: 5px; /* Add border radius */
            transition: background-color 0.3s ease; /* Add transition effect */
        }

        .SearchBar input[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade of blue on hover */
        }
    
    
    table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

#logoutBtn {
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
    margin-left: 870px; /* Adjust margin-left for positioning */
}

#logoutBtn:hover {
    background-color: #cc0000; /* Darker shade of red on hover */
}

.applyBtn {
    background-color: #4CAF50; /* Green color for apply button */
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.applyBtn:hover {
    background-color: #45a049; /* Darker shade of green on hover */
}
</style>
</head>
<body>
    <div style="display:flex;">
    <h1 style="text-align:center;">JOB LISTINGS</h1>
    <button id="logoutBtn">LOGOUT</button>
</div>
<div class="SearchBar" style="padding:20px;">
<form method="POST">
<input type="text"  name="n" placeholder="SEARCH FOR JOBS" >
<input type="submit" name="search" value="search">
</div>
</form>

<div STYLE="padding:20px;align:center;">
<table border='1' STYLE="padding:2px;text-align:center;" id="jobTable">
<tr>
<th></th>
<th STYLE="padding:3px">JOB NAME</th>
<th STYLE="padding:3px">SUMMARY</th>
<th STYLE="padding:3px">REQUIREMENTS</th>
<th STYLE="padding:3px">EDUCATION AND EXPERIENCE</th>
<th STYLE="padding:3px">LOCATION</th>
<th STYLE="padding:3px">COMPANY NAME</th>
<th STYLE="padding:3px">APPLY FOR YOUR JOB</th>
</tr>
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
    while($row=$result->fetch_assoc())
    {
    echo"<tr>
    <td><img src='" . $row['image'] . "' alt='Job Image' style='width: 100px; height: 100px;'></td>
    <td STYLE=\"padding:3px\">".$row['jname']."</td>    
    <td STYLE=\"padding:7px\">".$row['jsummary']."</td>
    <td STYLE=\"padding:5px\">".$row['jreq']."</td>
    <td STYLE=\"padding:7px\">".$row['expandedu']."</td>   
    <td STYLE=\"padding:3px\">".$row['jloc']."</td>
    <td STYLE=\"padding:3px\">".$row['cname']."</td>
    <td STYLE=\"padding:5px\"><button class='applyBtn' data-job='".$row['jname']."' data-company='".$row['cname']."'>APPLY</button></td>
    </tr>";
    }
}
else 
{
    echo"no listings for now!";
}

if(isset($_POST['search']))
	{
		$a=$_POST['n'];
		
		
		$sql="SELECT * FROM JOBDETAILS WHERE jname LIKE '%$a%'";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
	echo"<div style=\"padding:20px;border-style:solid;\">The searched Job details are:<br>";
	$row=$result->fetch_assoc();
	echo "<h2>".$row['jname']."</h2>";
    echo"<img src='" . $row['image'] . "' alt='Job Image' style='width: 100px; height: 100px;'><br>";
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
</table>
</div>
<div id="appliedjobDetails"></div>
<div id="message"></div>

<script>
$(document).ready(function(){
    var username = localStorage.getItem('username');
        if(username) {
                // Send AJAX request to fetch job details for the user
                $.ajax({
                    type: 'POST',
                    url: 'fetch_appliedjobs.php', // Create fetch_jobs.php to handle the request
                    data: {username: username},
                    success: function(response){
                        $('#appliedjobDetails').html(response);
                    }
                });
            }
            $('.applyBtn').click(function(){
    var username = localStorage.getItem('username');
    var jobname = $(this).data('job');
    var company = $(this).data('company'); // Retrieve the company name
    
    $.ajax({
        type: 'POST',
        url: 'apply.php',
        data: {username: username, jobname: jobname, company: company}, // Include company in data object
        success: function(response){
            $('#message').html(response);
        }
    });
});


    $('#logoutBtn').click(function(){
        localStorage.removeItem('username');
        window.location.href = 'home.html'; // Redirect to home page
    });
});
</script>

</body>
</html>
