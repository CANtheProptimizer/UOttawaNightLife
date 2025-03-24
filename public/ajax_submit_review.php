<?php
// ajax_submit_review.php

session_start();
require_once '../includes/config.php';
require_once '../includes/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['event_id'], $_POST['rating_value'])) {
    echo "Invalid request.";
    exit;
}

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo "You must be logged in.";
    exit;
}

$event_id     = $_POST['event_id'];
$rating_value = (int)$_POST['rating_value'];
$comment      = trim($_POST['comment'] ?? '');

if ($rating_value < 1 || $rating_value > 5) {
    echo "Please enter a valid rating between 1 and 5.";
    exit;
}

try {
    // Insert the new review
    $stmt = $pdo->prepare("INSERT INTO ratings (event_id, user_id, rating_value, comment) VALUES (?, ?, ?, ?)");
    $stmt->execute([$event_id, $user_id, $rating_value, $comment]);

    // Get the ID of the newly inserted review
    $rating_id = $pdo->lastInsertId();

    // Fetch the inserted review along with the user's full name using the correct column name "rating_id"
    $stmt = $pdo->prepare("SELECT r.*, u.full_name 
                           FROM ratings r 
                           JOIN users u ON r.user_id = u.user_id 
                           WHERE r.rating_id = ?");
    $stmt->execute([$rating_id]);
    $review = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($review) {
        ?>
        <div class="review">
            <p><strong><?php echo htmlspecialchars($review['full_name']); ?></strong> rated it <?php echo (int)$review['rating_value']; ?>/5</p>
            <?php if (!empty($review['comment'])): ?>
                <p>"<?php echo htmlspecialchars($review['comment']); ?>"</p>
            <?php endif; ?>
            <small>Posted on: <?php echo htmlspecialchars($review['created_at']); ?></small>
        </div>
        <?php
    } else {
        echo "Error fetching review.";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
