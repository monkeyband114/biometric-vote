<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = $_POST["name"];
    $voter_id = $_POST["voter_id"];
    $address = $_POST["address"];
    $fingerprint_data = $_FILES["fingerprint"]["tmp_name"];

    // Connect to the database (MySQL/MariaDB)
    $conn = new mysqli("localhost", "username", "password", "voting_database");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert voter data into the database
    $sql = "INSERT INTO voters (name, voter_id, address, fingerprint_data) VALUES ('$name', '$voter_id', '$address', ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("b", $fingerprint_data);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
