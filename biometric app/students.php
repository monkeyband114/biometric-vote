<!DOCTYPE html>
<html>
<head>
	<title>Student Data</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}

		tr:hover {
			background-color: #f5f5f5;
		}

		h1 {
			text-align: center;
			margin-top: 50px;
		}
	</style>
</head>
<body>
	<?php
		$servername = "localhost";
		$username = "username";
		$password = "password";
		$dbname = "voting_system";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		// Retrieve student data from database
		$sql = "SELECT id, name, email, department, level FROM students";
		$result = $conn->query($sql);

		// Display student data in a table
		if ($result->num_rows > 0) {
			echo "<h1>Student Data</h1>";
		    echo "<table>";
		    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Department</th><th>Level</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["department"]."</td><td>".$row["level"]."</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}
		$conn->close();
	?>
</body>
</html>
