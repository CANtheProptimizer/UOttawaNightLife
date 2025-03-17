<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- navbar.php -->
<nav class="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="search_events.php">Search</a></li>
        <li><a href="ratings_review.php">Ratings</a></li>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <!-- If the user is not logged in, show the auth link -->
            <li><a href="auth.php">Login / Register</a></li>
        <?php else: ?>
            <!-- If the user is logged in, show the logout link -->
            <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>
