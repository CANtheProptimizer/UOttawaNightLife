<?php
session_start();
require_once '../includes/config.php';  // <-- Make sure this sets up $pdo
require_once '../includes/session.php';

// If the form is submitted, process the data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Replace this with the real session user ID
    $user_id     = $_POST['user_id'] ?? 1;
    $title       = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $location    = $_POST['location'] ?? '';
    $event_date  = $_POST['event_date'] ?? '';

    try {
        // Insert into your 'events' table (adjust column names if needed)
        $stmt = $pdo->prepare("
            INSERT INTO events (user_id, title, description, location, event_date)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$user_id, $title, $description, $location, $event_date]);

        // Redirect to index.php with a success parameter
        header('Location: index.php?event_created=1');
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h2>Create a New Event</h2>

    <!-- Standard form submission -->
    <form action="create_event.php" method="POST">
        <input type="hidden" name="user_id" value="1"> 
        <input type="text" name="title" placeholder="Event Title" required>
        <textarea name="description" placeholder="Event Description"></textarea>
        <input type="text" name="location" placeholder="Enter Address">
        <input type="datetime-local" name="event_date" required>
        <button type="submit">Create Event</button>
    </form>
</body>
</html>
