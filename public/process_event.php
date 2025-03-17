<?php
require_once "../includes/config.php"; // connect to database
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $user_id = $_SESSION["user_id"] ?? 1; // get the ID of logged-in user (or default to 1)
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"] ?? null);
    $location = trim($_POST["location"]);
    $event_date = trim($_POST["event_date"]);

    // validate form inputs
    if (empty($title) || empty($event_date) || empty($location)) {
        echo json_encode(["status" => "error", "message" => "Title, Event Date, and Location are required."]);
        exit;
    }

    try {
        // insert event information into database (assuming we stay with PDO)
        $stmt = $pdo->prepare("INSERT INTO events (user_id, title, description, location, event_date) 
                               VALUES (:user_id, :title, :description, :location, :event_date)");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":location", $location, PDO::PARAM_STR);
        $stmt->bindParam(":event_date", $event_date, PDO::PARAM_STR);
        $stmt->execute();

        // send success response to JS
        echo json_encode(["status" => "success", "message" => "Event created successfully!"]);
    } catch (PDOException $e) {
        // send database error response to JS
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }

    exit;
}
?>
