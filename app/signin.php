<html>
<head>
    <script>
        function saveUsername() {
            var username = document.getElementById('username').value;
            localStorage.setItem('username', username);
        }
    </script>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Make the body full height */
        }

        .container {
            background-color: white;
            border: 1px solid transparent; /* Transparent border */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for a nice effect */
            padding: 20px;
            text-align: center;
        }

        .container form {
            margin-bottom: 20px;
        }

        .container form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .container form input[type="text"],
        .container form input[type="password"] {
            width: 200px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container form input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .container form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .container button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .container button:hover {
            background-color: #0056b3;
        }     
        .container a:hover {
            color: grey !important;
        }       

        
    </style>
</head>
<body>
<div class="container">
    <form method="POST" onsubmit="saveUsername()">
        
        <input placeholder="Username" type="text" name="u" id="username"><br>
        
        <input placeholder="Password" type="password" name="p"><br>
        <input type="submit" name="s" value="LOGIN">
    </form>
    <a href="signup.php" style="color:darkgrey;">Didn't Have An Account? Register Now!</a>
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

mysqli_select_db($conn,"RMS");
if(isset($_POST['s']))
{
    $a=$_POST['u'];
    $b=$_POST['p'];
    $f=0;
    $sql="SELECT * FROM USERS";
    $result=$conn->query($sql);
    while($row=$result->fetch_assoc())
    {
        if($row['Username']==$a && $row['Password']==$b)
        {
            $f=1;
            echo " ";
            // Save username in localStorage
            echo "<script>localStorage.setItem('username', '$a');</script>";
            header("Location: user.php"); // Redirect to user.php
            exit();
        }
    }
    if ($f==0)
        echo"login failed";
}
?>
