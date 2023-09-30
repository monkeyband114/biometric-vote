<!DOCTYPE html>
<html>
<head>
  <title>Add Candidate</title>
</head>
<body>
  <h1>Add Candidate</h1>
  <form method="post" action="add_candidate.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="position">Position:</label>
    <input type="text" id="position" name="position" required><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

    <input type="submit" value="Add Candidate">
  </form>

<?php
// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve candidate data from POST request
  $name = $_POST['name'];
  $email = $_POST['email'];
  $position = $_POST['position'];
  $description = $_POST['description'];

  // Connect to MySQL database
  $servername = "localhost";
  $username = "id20503064_brume_123";
  $password = "GTf]_J%fo2qm+?r=";
  $dbname = "id20503064_vote_data";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare SQL statement
  $sql = "INSERT INTO candidates (name, email, position, description) VALUES ('$name', '$email', '$position', '$description')";

  // Execute SQL statement
  if (mysqli_query($conn, $sql)) {
    echo "<p>Candidate added successfully</p>";
  } else {
    echo "<p>Error adding candidate: " . mysqli_error($conn) . "</p>";
  }

  // Close database connection
  mysqli_close($conn);
}
?>

</body>
</html>
