<?php
// delete_event.php - Handles deletion of an event

session_start();
require_once '../includes/config.php';
require_once '../includes/session.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $user_id  = $_SESSION['user_id'];

    // Check if the event belongs to the logged-in user
    $stmt = $pdo->prepare("SELECT user_id FROM events WHERE event_id = ?");
    $stmt->execute([$event_id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($event && $event['user_id'] == $user_id) {
        // Delete the event
        $stmt = $pdo->prepare("DELETE FROM events WHERE event_id = ?");
        $stmt->execute([$event_id]);
    }
}

header("Location: index.php");
exit;
?>
