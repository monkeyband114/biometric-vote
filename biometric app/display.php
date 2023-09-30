<!DOCTYPE html>
<html>
<head>
    <title>Verify Student Print ID</title>
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
                echo "<p>Name: " . $api_data['name'] . "</p>";
                echo "<p>Department: " . $api_data['department'] . "</p>";
                echo "<p>Level: " . $api_data['level'] . "</p>";
                echo "<p>Print ID: " . $api_data['print_id'] . "</p>";

                // Display the voting button
                echo "<form action=\"vote.php\" method=\"POST\">";
                echo "<input type=\"hidden\" name=\"print_id\" value=\"" . $print_id . "\">";
                echo "<input type=\"submit\" name=\"vote\" value=\"Vote\">";
                echo "</form>";
            }
        }
    ?>
</body>
</html>
