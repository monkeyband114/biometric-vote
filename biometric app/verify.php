<?php
// Replace with your database credentials
$host = "localhost";
$username = "id20503064_brume_123";
$password = "GTf]_J%fo2qm+?r=";
$dbname = "id20503064_vote_data";
// Connect to the database
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle the GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["print_id"])) {
        // Retrieve student data from the database
        $print_id = $_GET["print_id"];
        $sql = "SELECT * FROM students WHERE print_id = '$print_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the query returned any results
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row["name"];
            $print_id = $row["print_id"];
            $mat_no = $row["mat_no"];
            $department = $row["department"];
            $level = $row["level"];
            
            $response = array(
                "name" => $row["name"],
                "department" => $row["department"],
                "level" => $row["level"],
                "mat_no" => $row["mat_no"],
                "print_id" => $row["print_id"]
            );
            echo json_encode($response);
            $sql = "INSERT INTO displays (name, print_id, mat_no, department, level) VALUES ('$name', '$print_id', '$mat_no', '$department', '$level')";
            // Execute SQL statement
            if (mysqli_query($conn, $sql)) {
                echo "<p>Candidate added successfully</p>";
            } else {
                echo "<p>Error adding candidate: " . mysqli_error($conn) . "</p>";
            }
        } else {
            // Return an error message if no results were found
            http_response_code(404);
            echo json_encode(array("message" => "No student found with print_id = $print_id"));
        }
    } else {
        // Return an error message if no print_id parameter was provided
        http_response_code(400);
        echo json_encode(array("message" => "Missing print_id parameter"));
    }
} else {
    // Return an error message if the request method is not GET
    http_response_code(405);
    echo json_encode(array("message" => "Method not allowed"));
}

// Close the database connection
mysqli_close($conn);
?>
