<?php
// index.php - Single page for listing, reviewing, and rating events

session_start();
require_once '../includes/config.php';   // Provides $pdo
require_once '../includes/session.php';  // Starts session, etc.

// 1. Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$feedback = '';

// 2. Handle rating/review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'], $_POST['rating_value'])) {
    $event_id     = $_POST['event_id'];
    $rating_value = (int)$_POST['rating_value'];
    $comment      = trim($_POST['comment'] ?? '');

    // Basic validation for rating range
    if ($rating_value < 1 || $rating_value > 5) {
        $feedback = "Please enter a valid rating between 1 and 5.";
    } else {
        try {
            // Insert rating & review into 'ratings' table
            $stmt = $pdo->prepare("
                INSERT INTO ratings (event_id, user_id, rating_value, comment)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$event_id, $user_id, $rating_value, $comment]);
            $feedback = "Thank you for your review!";
        } catch (PDOException $e) {
            $feedback = "Database error: " . $e->getMessage();
        }
    }
}

// 3. Fetch all events (with average rating)
try {
    // We'll do a LEFT JOIN or subquery to get the average rating
    $sql = "
        SELECT e.*,
               (SELECT AVG(r.rating_value) 
                FROM ratings r 
                WHERE r.event_id = e.event_id
               ) AS avg_rating
        FROM events e
        ORDER BY e.event_date ASC
    ";
    $stmt = $pdo->query($sql);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// 4. Helper function to fetch reviews for each event
function fetchReviews($pdo, $event_id) {
    $sql = "
        SELECT r.*, u.full_name
        FROM ratings r
        JOIN users u ON r.user_id = u.user_id
        WHERE r.event_id = ?
        ORDER BY r.created_at DESC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$event_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Events - Rate & Review</title>
   
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <!-- Include your navbar -->
    <?php include '../includes/navbar.php'; ?>

    <div class="flexbox">
        <h1 id="allEventsHeader">All Events</h1>

        <!-- Link to create a new event -->
        <a href="create_event.php" id="createEventLink">Create a New Event</a>
    </div>
    
    <div class="container">

        <!-- Display feedback  -->
        <?php if (!empty($feedback)): ?>
            <p style="color: green;"><?php echo htmlspecialchars($feedback); ?></p>
        <?php endif; ?>

        <!-- List all events -->
        <?php if (!empty($events)): ?>
            <ul style="list-style-type: none; padding: 0;">
                <?php foreach ($events as $event): ?>
                    <li class="eventListItem">
                        <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                        <p><?php echo htmlspecialchars($event['description']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>

                        <?php 
                        $avg = $event['avg_rating'];
                        if ($avg) {
                            echo "<p>Average Rating: " . number_format($avg, 1) . "/5</p>";
                        } else {
                            echo "<p>No ratings yet.</p>";
                        }
                        ?>

                        <!-- Fetch and display existing reviews for this event -->
                        <?php
                        $reviews = fetchReviews($pdo, $event['event_id']);
                        if ($reviews):
                            echo "<h4>Reviews:</h4>";
                            foreach ($reviews as $rev):
                                ?>
                                <div style="border: 1px solid #ddd; margin: 5px 0; padding: 10px;">
                                    <p><strong><?php echo htmlspecialchars($rev['full_name']); ?></strong> 
                                       rated it <?php echo (int)$rev['rating_value']; ?>/5</p>
                                    <?php if (!empty($rev['comment'])): ?>
                                        <p>"<?php echo htmlspecialchars($rev['comment']); ?>"</p>
                                    <?php endif; ?>
                                    <small>Posted on: <?php echo htmlspecialchars($rev['created_at']); ?></small>
                                </div>
                                <?php
                            endforeach;
                        else:
                            echo "<p>No reviews yet. Be the first to review!</p>";
                        endif;
                        ?>

                        <!-- Inline rating & review form -->
                        <h4>Rate & Review This Event</h4>
                        <form method="POST" action="">
                            
                            <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">

                            <label for="rating_value_<?php echo $event['event_id']; ?>">
                                Rating (1-5):
                            </label>
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
                                      cols="50">
                            </textarea>
                            <br><br>

                            <button type="submit">Submit</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No events found. Create one!</p>
        <?php endif; ?>

    </div>
</body>
</html>
