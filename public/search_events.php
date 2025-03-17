<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uottawa_nightlife";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_keyword = '';
$events = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET['keyword'])) {
    $search_keyword = trim($_GET['keyword']);
    
    $sql = "SELECT * FROM events WHERE title LIKE ? OR location LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%" . $search_keyword . "%";
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Events</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .event { border: 1px solid #ddd; padding: 10px; margin: 10px 0; border-radius: 5px; background-color: #f9f9f9; }
        .search-box { margin-bottom: 20px; }
        input[type="text"] { width: 80%; padding: 8px; }
        button { padding: 8px 12px; background: #007bff; color: #fff; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
<body>
    <?php require_once '../includes/navbar.php'; ?>
    <link rel="stylesheet" href="assets/styles.css">

    <div class="container">
        <h2>Search Events</h2>
        <form method="GET" class="search-box">
            <input type="text" name="keyword" value="<?php echo htmlspecialchars($search_keyword); ?>" placeholder="Search by title or location" required>
            <button type="submit">Search</button>
        </form>
        
        <?php if (!empty($events)): ?>
            <h3>Search Results:</h3>
            <?php foreach ($events as $event): ?>
                <div class="event">
                    <h4><?php echo htmlspecialchars($event['title']); ?></h4>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                    <!-- Updated to match your column name -->
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php elseif ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET['keyword'])): ?>
            <p>No events found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
