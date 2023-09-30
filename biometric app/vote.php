<?php
session_start();
require_once('config.php');

// Redirect to login page if the voter is not logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit;
}

// Check if the voter has already submitted their votes
$student_id = $_SESSION['student_id'];
$stmt = $pdo->prepare("SELECT * FROM votes WHERE student_id = ?");
$stmt->execute([$student_id]);
$votes = $stmt->fetchAll();
if (count($votes) > 0) {
    // Display an error message if the voter has already submitted their votes
    $error_message = 'You have already submitted your votes.';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $president_id = $_POST['president'];
    $vice_president_id = $_POST['vice_president'];
    $secretary_id = $_POST['secretary'];
    $treasurer_id = $_POST['treasurer'];
    $auditor_id = $_POST['auditor'];

    // Insert the new votes into the database
    $stmt = $pdo->prepare("INSERT INTO votes (student_id, president_id, vice_president_id, secretary_id, treasurer_id, auditor_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$student_id, $president_id, $vice_president_id, $secretary_id, $treasurer_id, $auditor_id]);

    // Redirect to the confirmation page
    header('Location: confirmation.php');
    exit;
}

// Get the list of candidates
$stmt = $pdo->query("SELECT * FROM candidates");

// Group the candidates by position
$candidates_by_position = [];
while ($candidate = $stmt->fetch()) {
    $candidates_by_position[$candidate['position']][] = $candidate;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voting System - Vote</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        h1 {
            margin-top: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        h2 {
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
        }

        input[type="submit"]:hover {
            background-color: #0069d9;
        }

        p.error-message {
            color: red;
            margin-top: 20px;
        }
    </style>

</head>
<body>
    <h1>Voting System</h1>
    <h2>Vote</h2>
    <?php if (isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <h3>President</h3>
        <?php foreach ($candidates_by_position['President'] as $candidate): ?>
            <label>
                <input type="radio" name="president" value="<?php echo $candidate['id']; ?>" required>
                <?php echo $candidate['name']; ?>
            </label><br>
        <?php endforeach; ?>
        <h3>Vice President</h3>
        <?php foreach ($candidates_by_position['Vice President'] as $candidate): ?>
            <label>
                <input type="radio" name="vice_president" value="<?php echo $candidate['id']; ?>" required>
                <?php echo $candidate['name']; ?>
            </label><br>
        <?php endforeach; ?>
        <h3>Secretary</h3>
        <?php foreach ($candidates_by_position['Secretary'] as $candidate): ?>
            <label>
                <input type="radio" name="secretary" value="<?php echo $candidate['id']; ?>" required>
                <?php echo $candidate['name']; ?>
            </label><br>
        <?php endforeach; ?>
        <h3>Treasurer</h3>
        <?php foreach ($candidates_by_position['Treasurer'] as $candidate): ?>
            <label>
                <input type="radio" name="treasurer" value="<?php echo $candidate['id']; ?>" required>
                <?php echo $candidate['name']; ?>
            </label><br>
        <?php endforeach; ?>
        <h3>Auditor</h3>
        <?php foreach ($candidates_by_position['Auditor'] as $candidate): ?>
            <label>
                <input type="radio" name="auditor" value="<?php echo $candidate['id']; ?>" required>
                <?php echo $candidate['name']; ?>
            </label><br>
        <?php endforeach; ?>
        <br>
        <input type="submit" value="Submit Vote">
    </form>
</body>
</html>
