<?php
// create_event.php - Page for creating a new event

session_start();
require_once '../includes/config.php';   // Provides $pdo
require_once '../includes/session.php';  // Manages session, etc.

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

$feedback = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name  = trim($_POST['event_name'] ?? '');
    $event_date  = trim($_POST['event_date'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // Minimal server-side validation
    if (empty($event_name) || empty($event_date) || empty($description)) {
        $feedback = "Please fill in all required fields.";
    } else {
        try {
            // Updated query includes user_id to satisfy the foreign key constraint.
            $stmt = $pdo->prepare("INSERT INTO events (user_id, title, event_date, description, location) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $event_name, $event_date, $description, 'Unknown']);
            $feedback = "Event created successfully!";
        } catch (PDOException $e) {
            $feedback = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        /* Basic styles for the form */
        .container {
            max-width: 600px;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        #charCounter {
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="container">
        <h2>Create a New Event</h2>
        <?php if (!empty($feedback)): ?>
            <p style="color: green;"><?php echo htmlspecialchars($feedback); ?></p>
        <?php endif; ?>

        <!-- Event Creation Form -->
        <form id="createEventForm" action="" method="POST">
            <div>
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" required>
            </div>
            <div>
                <label for="event_date">Event Date:</label>
                <input type="date" id="event_date" name="event_date" required>
            </div>
            <div>
                <label for="description">Event Description:</label>
                <textarea id="description" name="description" rows="5" required></textarea>
                <div id="charCounter">0 characters</div>
            </div>
            <div>
                <button type="submit">Create Event</button>
            </div>
        </form>
    </div>

    <script src="../assets/script.js"></script>
</body>
</html>
