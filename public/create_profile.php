<?php
require_once '../includes/config.php'; // Database connection
require_once '../includes/session.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];

    if (empty($email) || empty($password) || empty($full_name)) {
        echo "All fields are required.";
        exit;
    }

    try {
        // Insert user into the database
        $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, full_name) VALUES (?, ?, ?)");
        $stmt->execute([$email, $password, $full_name]);
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
</head>
<body>
    <form method="POST">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <input type="text" name="full_name" required placeholder="Full Name">
        <button type="submit">Register</button>
    </form>
</body>
</html>