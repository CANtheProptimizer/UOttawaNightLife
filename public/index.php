<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/session.php';

// Show success message if redirected after creating an event
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
    <title>Events</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>All Events</h1>

    <?php if ($events): ?>
        <ul>
            <?php foreach ($events as $event): ?>
                <li>
                    <h3><?= htmlspecialchars($event['title']) ?></h3>
                    <p><?= htmlspecialchars($event['description']) ?></p>
                    <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
                    <p><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No events found. Create one!</p>
    <?php endif; ?>

    <a href="create_event.php">Create a New Event</a>
</body>
</html>
