
<!-- Form to input event title, description, location, date/time. -->
<!-- PHP code to insert a new event into events table, referencing the logged-in user (user_id). -->

<?php
session_start();
$user_id = $_SESSION["user_id"] ?? 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <h2>Create a New Event!</h2>
    <form id="eventForm">
        <input type="hidden" name="user_id" value="1"> <!-- replace the 1 here later with session user ID -->
        <input type="text" name="title" placeholder="Event Title" required>
        <textarea name="description" placeholder="Event Description"></textarea>
        <input type="text" name="location" placeholder="Enter Address">
        <input type="datetime-local" name="event_date" required>
        <button type="submit">Create Event</button>

    </form>

    <div id="statusmessage"></div> <!-- event creation success/error message -->

    <script src="../assets/js/event.js"></script>
</body>

</html>