<?php
// search_events.php

//  Start session and check if user is logged in
require_once '../includes/session.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$feedback = '';

//  Set up sql connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "uottawa_nightlife";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//  Process rating/review submission 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['event_id'], $_POST['rating_value'])) {
    $event_id     = $_POST['event_id'];
    $rating_value = intval($_POST['rating_value']);
    $comment      = trim($_POST['comment'] ?? '');

    if ($rating_value < 1 || $rating_value > 5) {
        $feedback = "Please enter a valid rating between 1 and 5.";
    } else {
        $stmt = $conn->prepare("INSERT INTO ratings (event_id, user_id, rating_value, comment) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("iiis", $event_id, $user_id, $rating_value, $comment);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $feedback = "Thank you for your review!";
            } else {
                $feedback = "Failed to submit review.";
            }
            $stmt->close();
        } else {
            $feedback = "Database error: " . $conn->error;
        }
    }
}

//  Process search query 
$search_keyword = '';
$events = [];
if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET['keyword'])) {
    $search_keyword = trim($_GET['keyword']);
    
    $sql = "SELECT * FROM events WHERE title LIKE ? OR location LIKE ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $search_param = "%" . $search_keyword . "%";
        $stmt->bind_param("ss", $search_param, $search_param);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        $stmt->close();
    }
}

//  Function to fetch reviews for an event
function fetchReviews($conn, $event_id) {
    $reviews = [];
    $sql = "SELECT r.*, u.full_name 
            FROM ratings r 
            JOIN users u ON r.user_id = u.user_id 
            WHERE r.event_id = ? 
            ORDER BY r.created_at DESC";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
        $stmt->close();
    }
    return $reviews;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Events</title>
   
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .event { border: 1px solid #ddd; padding: 10px; margin: 10px 0; border-radius: 5px; background-color: #f9f9f9; }
        .review { border: 1px solid #ccc; padding: 5px; margin: 5px 0; }
        .search-box { margin-bottom: 20px; }
        input[type="text"] { width: 80%; padding: 8px; }
        button { padding: 8px 12px; background: #007bff; color: #fff; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
   
    <?php require_once '../includes/navbar.php'; ?>

    <div class="container">
        <h2>Search Events</h2>

        
        <?php if (!empty($feedback)): ?>
            <p style="color: green;"><?php echo htmlspecialchars($feedback); ?></p>
        <?php endif; ?>

        
        <form method="GET" class="search-box">
            <input 
                type="text" 
                name="keyword" 
                value="<?php echo htmlspecialchars($search_keyword); ?>" 
                placeholder="Search by title or location" 
                required>
            <button type="submit">Search</button>
        </form>
        
        
        <?php if (!empty($events)): ?>
            <h3>Search Results:</h3>
            <?php foreach ($events as $event): ?>
                <div class="event">
                    <h4><?php echo htmlspecialchars($event['title']); ?></h4>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>

                    
                    <h4>Rate & Review This Event</h4>
                    <form method="POST" action="">
                        <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
                        <label for="rating_value_<?php echo $event['event_id']; ?>">Rating (1-5):</label>
                        <input type="number" 
                               id="rating_value_<?php echo $event['event_id']; ?>" 
                               name="rating_value" 
                               min="1" max="5" 
                               required>
                        <br><br>
                        <label for="comment_<?php echo $event['event_id']; ?>">Comment:</label><br>
                        <textarea id="comment_<?php echo $event['event_id']; ?>" 
                                  name="comment" 
                                  rows="3" 
                                  cols="50"></textarea>
                        <br><br>
                        <button type="submit">Submit Review</button>
                    </form>

                    
                    <?php 
                    $reviews = fetchReviews($conn, $event['event_id']);
                    if (!empty($reviews)): 
                    ?>
                        <h4>Reviews:</h4>
                        <?php foreach ($reviews as $review): ?>
                            <div class="review">
                                <p><strong><?php echo htmlspecialchars($review['full_name']); ?></strong> rated it <?php echo (int)$review['rating_value']; ?>/5</p>
                                <?php if (!empty($review['comment'])): ?>
                                    <p>"<?php echo htmlspecialchars($review['comment']); ?>"</p>
                                <?php endif; ?>
                                <small>Posted on: <?php echo htmlspecialchars($review['created_at']); ?></small>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No reviews yet. Be the first to review!</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php elseif ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET['keyword'])): ?>
            <p>No events found.</p>
        <?php endif; ?>
    </div>

    <script src="assets/script.js"></script>

</body>
</html>
<?php

$conn->close();
?>