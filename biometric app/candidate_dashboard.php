<!DOCTYPE html>
<html>
<head>
    <title>Candidate Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        h1, h2 {
            color: #336699;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .stats p {
            margin: 0;
            padding: 10px;
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        a {
            color: #336699;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $candidate_name; ?>!</h1>
        <p>Your department: <?php echo $candidate_department; ?></p>
        <p>Your position: <?php echo $candidate_position; ?></p>
        <h2>Vote Statistics</h2>
        <div class="stats">
            <p>Total votes received: <?php echo $total_votes; ?></p>
            <p>Valid votes received: <?php echo $valid_votes; ?></p>
            <p>Invalid votes received: <?php echo $invalid_votes; ?></p>
        </div>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
