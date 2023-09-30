<!DOCTYPE html>
<html>
<head>
    <title>Voting System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            margin: 0 auto;
            width: 50%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: block;
            margin: 0 auto;
            width: 80%;
            text-align: center;
        }
        input[type=submit] {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type=radio] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Voting System</h1>
        <?php
        // connect to the database
        $host = "localhost";
        $user = "username";
        $password = "password";
        $database = "voting_system";

        $conn = mysqli_connect($host, $user, $password, $database);

        // check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // get the list of candidates and display them in a form
        $sql = "SELECT * FROM candidates";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<form method='post' action=''>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<label><input type='radio' name='candidate_id' value='" . $row["id"] . "'>" . $row["name"] . "</label>";
            }
            echo "<input type='submit' value='Submit Vote'>";
            echo "</form>";
        }

        // check if a vote was submitted and insert it into the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $candidate_id = $_POST["candidate_id"];

            // insert the vote into the database
            $sql = "INSERT INTO votes (voter_id, candidate_id, session_id) VALUES (1, $candidate_id, 1)";
            mysqli_query($conn, $sql);

            echo "<p>Vote submitted successfully!</p>";
        }

        // close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
