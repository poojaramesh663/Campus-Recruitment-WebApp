<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("error connecting" . $conn->connect_error . "<br>");
} else {
    echo "";
}
mysqli_select_db($conn, "RMS");
$sql = "CREATE TABLE IF NOT EXISTS RECRUITERS( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,Username VARCHAR(30),Password VARCHAR(30))";
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "error" . $conn->error . "<br>";
}
if (isset($_POST['s'])) {
    $a = $_POST['u'];
    $b = $_POST['p'];

    $sql = "INSERT INTO RECRUITERS(Username,Password)VALUES('$a','$b')";
    if ($conn->query($sql) === TRUE) {
        echo "";
        echo "<script>localStorage.setItem('username', '$a');</script>";
        // Since we're already on the same page, we don't need to use header
        // Redirecting using JavaScript
        echo "<script>window.location.href = 'recruiter.php';</script>";
        exit();
    } else {
        echo "error" . $conn->error . "<br>";
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
        <h3>Register Your Company</h3>
    <form method="POST" onsubmit="saveUsername()">
        <input type="text" placeholder="Company name" required>
        <input type="text" placeholder="Address" required><br>
        <input placeholder="Username" type="text" name="u" id="username" required><br>
        <input placeholder="Password" type="password" name="p"id="password" required oninput="validatePassword()"><br>
        <p id="message" style="color:red;"></p>
        <input type="submit" name="s" value="Register" id="registerButton" disabled>
    </form>
    </div>
</body>

</html>
