<?php
session_start();
require_once '../includes/config.php';  // sets up $pdo
require_once '../includes/session.php';

// Check if an event was just created and display a confirmation message
if (isset($_GET['event_created'])) {
    echo "<p style='color: green;'>Event created successfully!</p>";
}

// Fetch all events from the database
try {
    $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events - uOttawa NightLife</title>
    <link rel="stylesheet" href="assets/styles.css">

</head>
<body>
    <!-- Include the navigation bar -->
    <?php require_once '../includes/navbar.php'; ?>

    <!-- Search bar at the top of the page -->
    <header>
        <form method="GET" action="search_events.php" style="margin-bottom: 20px;">
            <input type="text" name="keyword" placeholder="Search events..." required>
            <button type="submit">Search</button>
        </form>
    </header>

    <!-- Main content container -->
    <div class="container">
        <h1>All Events</h1>
        <?php if ($events): ?>
            <ul>
                <?php foreach ($events as $event): ?>
                    <li>
                        <h3><?= htmlspecialchars($event['title']); ?></h3>
                        <p><?= htmlspecialchars($event['description']); ?></p>
                        <p><strong>Location:</strong> <?= htmlspecialchars($event['location']); ?></p>
                        <p><strong>Date:</strong> <?= htmlspecialchars($event['event_date']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No events found. Create one!</p>
        <?php endif; ?>
        <a href="create_event.php">Create a New Event</a>
    </div>
</body>
</html>
