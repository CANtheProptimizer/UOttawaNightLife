<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_keyword = '';
$events = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_keyword = trim($_POST['keyword']);
    
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
        .event { border: 1px solid #ddd; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h2>Search Events</h2>
    <form method="POST">
        <input type="text" name="keyword" value="<?php echo htmlspecialchars($search_keyword); ?>" placeholder="Search by title or location" required>
        <button type="submit">Search</button>
    </form>
    
    <?php if (!empty($events)): ?>
        <h3>Search Results:</h3>
        <?php foreach ($events as $event): ?>
            <div class="event">
                <h4><?php echo htmlspecialchars($event['title']); ?></h4>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>No events found.</p>
    <?php endif; ?>
</body>
</html>
