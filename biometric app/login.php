<?php
session_start();
require_once('config.php');

// Redirect to index page if the voter is already logged in
if (isset($_SESSION['student_id'])) {
    header('Location: index.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];

    // Check if the student ID is valid
    $stmt = $pdo->prepare("SELECT * FROM voters WHERE student_id = ?");
    $stmt->execute([$student_id]);
    $voter = $stmt->fetch();
    if ($voter) {
        // Set the voter's ID in the session
        $_SESSION['student_id'] = $voter['student_id'];

        // Redirect to the index page
        header('Location: index.php');
        exit;
    } else {
        // Display an error message if the student ID is invalid
        $error_message = 'Invalid student ID. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voting System - Login</title>
</head>
<body>
    <h1>Voting System</h1>
    <h2>Login</h2>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>
            Student ID:
            <input type="text" name="student_id" required>
        </label><br>
        <button type="submit">Log in</button>
    </form>
</body>
</html>
