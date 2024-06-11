<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "RMS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("error connecting" . $conn->connect_error . "<br>");
} else {
    echo "";
}

mysqli_select_db($conn, "RMS");

$sql = "CREATE TABLE IF NOT EXISTS USERS( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,Username VARCHAR(30),Password VARCHAR(30),name VARCHAR(20),address VARCHAR(100),skills VARCHAR(100),languages VARCHAR(100),age VARCHAR(30),email VARCHAR(30),phone VARCHAR(30), resume VARCHAR(255))";
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "error" . $conn->error . "<br>";
}

if (isset($_POST['s'])) {
    // Retrieve form data
    $a = $_POST['u'];
    $c = $_POST['p'];
    $b = $_POST['n'];
    $d = $_POST['a'];
    $e = $_POST['sk'];
    $f = $_POST['l'];
    $g = $_POST['ag'];
    $h = $_POST['e'];
    $i = $_POST['p'];
	$sqll = "CREATE TABLE IF NOT EXISTS `$a`( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,jobname VARCHAR(30),company VARCHAR(30))";
    if ($conn->query($sqll) === TRUE) {
        echo "";
    } else {
        echo "error" . $conn->error . "<br>";
    }

    // Handle file upload
    $targetDirectory = "uploads/"; // Specify the directory where you want to store the uploaded files
    $targetFile = $targetDirectory . basename($_FILES["resume"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size (optional)
    if ($_FILES["resume"]["size"] > 500000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats (optional)
    if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "Sorry, only PDF, DOC, and DOCX files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["resume"]["name"])). " has been uploaded.<br>";
            // Insert data into the database, including the file path
            $sql = "INSERT INTO USERS(Username,Password,name,address,skills,languages,age,email,phone, resume) VALUES('$a','$c','$b','$d','$e','$f','$g','$h','$i', '$targetFile')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully.<br>";
                // Set the username in localStorage
                echo "<script>localStorage.setItem('username', '$a');</script>";
                // Redirect to user.php
                header("Location: user.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
?>

<html>

<head>
    <script>
        function saveUsername() {
            var username = document.getElementById('username').value;
            localStorage.setItem('username', username);
        }
        function validatePassword() {
            var password = document.getElementById("password").value;
            var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;

            if (passwordRegex.test(password)) {
                document.getElementById("message").innerHTML = "";
                document.getElementById("registerButton").disabled = false;
                return true;
            } else {
                document.getElementById("message").innerHTML = "Password must contain at least 6 characters with both letters and numbers.";
                document.getElementById("registerButton").disabled = true;
                return false;
            }
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
        .container form input[type="tel"],
        .container form input[type="email"],
        .container form input[type="number"],
        .container form input[type="password"],
        .container form textarea {
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

        .container textarea {
            width: 200px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical; /* Allow vertical resizing */
        }

        .container a:hover {
            color: grey !important;
        }       

    </style>
</head>

<body>
<div class="container">
        <h3>User Registration</h3>
        <form method="POST" onsubmit="saveUsername()" enctype="multipart/form-data">  
        <input type="text" name="n" placeholder="Name" required><br>
        <textarea type="text" name="a" placeholder="Address" required></textarea><br>
        <input type="email" name="e" placeholder="Email" required>
        <input type="tel" name="p" placeholder="Phone" required><br>
        <input type="number" name="ag" placeholder="Age" min="19" max="35" required><br>
        <textarea type="text" name="sk" placeholder="Skills" required></textarea>
        <textarea type="text" name="l" placeholder="Languages" required></textarea><br>
        <label>Upload Your Resume</label>
        <input type="file" name="resume" required><br><br>
        <input type="text" name="u" id="username" placeholder="Username" required><br>
        <input type="password" id="password" name="p" placeholder="Password" oninput="validatePassword()" required><br>
        <p id="message" style="color:red;"></p>
        <input type="submit" id="registerButton" name="s" value="Register User" disabled>
    </form>
    </div>
</body>

</html>
