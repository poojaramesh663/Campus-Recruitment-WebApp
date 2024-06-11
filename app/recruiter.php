<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
        #logoutBtn{
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
        #logoutBtn:hover{
            background-color: darkred;
        }
        button:hover {
            background-color: #0056b3;
        }

        #jobDetails {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    
    <button id="listjobs"><a href="joblist.php" style="text-decoration:none;color:white;">LIST YOUR JOBS</a></button>
    <button id="logoutBtn">LOGOUT</button>
    <div id="jobDetails"></div>

    <script>
        $(document).ready(function(){
            $('#logoutBtn').click(function(){
                localStorage.removeItem('username');
                window.location.href = 'home.html'; // Redirect to home page
            });

            // Retrieve username from localStorage
            var username = localStorage.getItem('username');
            if(username) {
                // Send AJAX request to fetch job details for the user
                $.ajax({
                    type: 'POST',
                    url: 'fetch_jobs.php', // Create fetch_jobs.php to handle the request
                    data: {username: username},
                    success: function(response){
                        $('#jobDetails').html(response);
                    }
                });
            }
        });
    </script>
</body>
</html>
