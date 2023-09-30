<!DOCTYPE html>
<html>
<head>
    <title>Verify Student Print ID</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 50%;
            margin: auto;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .student-data {
            width: 50%;
            margin: 50px auto;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 20px;
        }

        .student-data p {
            margin: 10px 0;
        }

        .vote-button {
            margin-top: 20px;
        }

        .vote-button input[type="submit"] {
            background-color: #008CBA;
        }

        .vote-button input[type="submit"]:hover {
            background-color: #00698C;
        }
    </style>
</head>
<body>
    <h1>Verify Student Print ID</h1>
    <form action="verify.php" method="GET">
        <label for="print_id">Enter Print ID:</label>
        <input type="text" name="print_id" id="print_id">
        <input type="submit" value="Verify">
    </form>
    <?php
        // Check if the print_id parameter is set
        if (isset($_GET['print_id'])) {
            // Retrieve the print_id parameter value
            $print_id = $_GET['print_id'];

            // Send a GET request to the student API to retrieve the student data
            $api_url = "http://your_api_host/api/student.php?print_id=" . urlencode($print_id);
            $api_response = file_get_contents($api_url);
            $api_data = json_decode($api_response, true);

            // Check if the API returned an error message
            if (isset($api_data['error'])) {
                echo "<p>Error: " . $api_data['error'] . "</p>";
            } else {
                // Print the student data
                echo "<div class=\"student-data\">";
                echo "<p><strong>Name:</strong> " . $api_data['name'] . "</p>";
                echo "<p><strong>Department:</strong> " . $api_data['department'] . "</p>";
                echo "<p><strong>Level:</strong> " . $api_data['level'] . "</p>";
                echo "<p><strong>Print ID:</strong> " . $api_data['print_id'] . "</p>";
                echo "</div>";

                // Display the voting button
                echo "<div class=\"vote-button\">";
                echo "<form action=\"vote.php\" method=\"POST\">";
                echo "<input type=\"hidden\" name=\"print_id\" value=\"". $print_id . "\">";
                echo "<input type=\"submit\" name=\"vote\" value=\"Vote\">";
                echo "</form>";
            }
        }
    ?>
</body>
</html>
