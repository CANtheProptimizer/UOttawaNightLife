<?php
// search_events.php

// 1. Start session & check if user is logged in
require_once '../includes/session.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

// 2. (Optional) If you prefer PDO, use $pdo from config.php
//    But here, we'll use MySQLi as in your example:
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "uottawa_nightlife";

// 3. Connect to the database via MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 4. Initialize variables
$search_keyword = '';
$events = [];

// 5. If user submitted a search (GET request with 'keyword')
if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET['keyword'])) {
    $search_keyword = trim($_GET['keyword']);

    $sql = "SELECT * FROM events WHERE title LIKE ? OR location LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%" . $search_keyword . "%";
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    // 6. Fetch all matching rows
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    $stmt->close();
}

// 7. Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Events</title>
    <!-- Adjust the path to your CSS if needed -->
    <link rel="stylesheet" href="assets/styles.css">

    <style>
        /* Additional inline styling if desired */
        body {
            font-family: Arial, sans-serif; 
            margin: 20px;
        }
        .container {
            max-width: 600px; 
            margin: 0 auto;
        }
        .event {
            border: 1px solid #ddd; 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px; 
            background-color: #f9f9f9;
        }
        .search-box {
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 80%; 
            padding: 8px;
        }
        button {
            padding: 8px 12px; 
            background: #007bff; 
            color: #fff; 
            border: none; 
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <!-- 8. Include your navbar -->
    <?php require_once '../includes/navbar.php'; ?>

    <div class="container">
        <h2>Search Events</h2>

        <!-- 9. Search form -->
        <form method="GET" class="search-box">
            <input 
                type="text" 
                name="keyword" 
                value="<?php echo htmlspecialchars($search_keyword); ?>" 
                placeholder="Search by title or location" 
                required
            >
            <button type="submit">Search</button>
        </form>
        
        <!-- 10. Display results -->
        <?php if (!empty($events)): ?>
            <h3>Search Results:</h3>
            <?php foreach ($events as $event): ?>
                <div class="event">
                    <h4><?php echo htmlspecialchars($event['title']); ?></h4>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php elseif ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET['keyword'])): ?>
            <p>No events found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
