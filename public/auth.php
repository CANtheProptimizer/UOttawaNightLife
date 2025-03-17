<?php
// auth.php

// 1. Include your config and session setup
require_once '../includes/config.php';  // This should set up $pdo
require_once '../includes/session.php'; // Contains session_start() etc.

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// We'll store any feedback (errors, success messages) here
$feedback = '';

// 2. Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Which form is submitted? (login or register)
    $form_type = $_POST['form_type'] ?? '';

    if ($form_type === 'login') {
        // --- LOGIN LOGIC ---
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $feedback = "Both fields are required.";
        } else {
            try {
                // Check if user exists in DB
                $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ? AND password_hash = ?");
                $stmt->execute([$email, $password]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    // Log in
                    $_SESSION['user_id'] = $user['user_id'];
                    // Redirect to homepage
                    header("Location: index.php");
                    exit;
                } else {
                    $feedback = "Invalid email or password.";
                }
            } catch (PDOException $e) {
                $feedback = "Error: " . $e->getMessage();
            }
        }
    } elseif ($form_type === 'register') {
        // --- REGISTRATION LOGIC ---
        $email     = $_POST['email'] ?? '';
        $password  = $_POST['password'] ?? '';
        $full_name = $_POST['full_name'] ?? '';

        if (empty($email) || empty($password) || empty($full_name)) {
            $feedback = "All fields are required.";
        } else {
            try {
                // Insert new user
                $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, full_name) VALUES (?, ?, ?)");
                $stmt->execute([$email, $password, $full_name]);

                // Automatically log in the new user
                $new_user_id = $pdo->lastInsertId();
                $_SESSION['user_id'] = $new_user_id;

                // Redirect to homepage
                header("Location: index.php");
                exit;
            } catch (PDOException $e) {
                $feedback = "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Register</title>
    <!-- Main stylesheet (adjust path if needed) -->
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        .form-box {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<!-- 3. Include your navbar -->
<?php require_once '../includes/navbar.php'; ?>

<div class="container">
    <h1>Welcome to uOttawa NightLife!</h1>
    
    <!-- 4. Display any feedback (errors, success messages) -->
    <?php if (!empty($feedback)): ?>
        <p style="color:red;"> <?php echo htmlspecialchars($feedback); ?> </p>
    <?php endif; ?>

    <!-- LOGIN FORM -->
    <div class="form-box">
        <h2>Login</h2>
        <form method="POST" action="auth.php">
            <input type="hidden" name="form_type" value="login">

            <label for="login_email">Email:</label>
            <input type="email" id="login_email" name="email" required>

            <label for="login_password">Password:</label>
            <input type="password" id="login_password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>

    <!-- Add spacing between sections -->
    <br><br><hr><br><br>

    <!-- REGISTRATION FORM -->
    <h2>Create an Account</h2>
    <form method="POST" action="auth.php">
        <input type="hidden" name="form_type" value="register">

        <label for="reg_email">Email:</label>
        <input type="email" id="reg_email" name="email" required>

        <label for="reg_password">Password:</label>
        <input type="password" id="reg_password" name="password" required>

        <label for="reg_full_name">Full Name:</label>
        <input type="text" id="reg_full_name" name="full_name" required>

        <button type="submit">Register</button>
    </form>

    <!-- Add spacing before Create Event section -->
    <br><br><hr><br><br>

    <!-- CREATE EVENT FORM (Placeholder if applicable) -->
    <div class="form-box">
        <h2>Create an Event</h2>
        <form method="POST" action="create_event.php">
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" required>

            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date" required>

            <label for="event_location">Event Location:</label>
            <input type="text" id="event_location" name="event_location" required>

            <button type="submit">Create Event</button>
        </form>
    </div>
</div>

</body>
</html>
