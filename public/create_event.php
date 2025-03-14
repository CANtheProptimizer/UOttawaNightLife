
#Form to input event title, description, location, date/time.
#PHP code to insert a new event into events table, referencing the logged-in user (user_id).

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
    <link rel="stylesheet" href="">
</head>

<body>
    <h2>Create a New Event!</h2>
    <form action="create_event.php" method="POST" id="eventForm">
        <input type="hidden" name="user_id" value="1">
        <input type="text" name="title" placeholder="Event Title" required>

    </form>
</body>

</html>