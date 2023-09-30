<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // TODO: Validate input data

    // Connect to database
    $host = "localhost";
    $username = "id20503064_brume_123";
    $password = "GTf]_J%fo2qm+?r=";
    $dbname = "id20503064_vote_data";
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare query
    $sql = "SELECT id, name, department, position FROM candidates WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Check if login is successful
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Save candidate data in session
        $_SESSION['candidate_id'] = $row['id'];
        $_SESSION['candidate_name'] = $row['name'];
        $_SESSION['candidate_department'] = $row['department'];
        $_SESSION['candidate_position'] = $row['position'];

        // Redirect to candidate dashboard
        header('Location: candidate_dashboard.php');
        exit();
    } else {
        // Invalid login
        $error_msg = "Invalid email.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Candidate Login</title>
</head>
<body>
    <h1>Candidate Login</h1>
    <?php
    if (isset($error_msg)) {
        echo "<p style='color: red;'>$error_msg</p>";
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
