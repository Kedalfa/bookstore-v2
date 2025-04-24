<?php
require_once '../config/db.php'; // DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if fields are empty
    if (empty($name) || empty($email) || empty($password)) {
        die("Please fill all fields.");
    }

    // Check if user already exists
    $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->execute([$email]);

    if ($checkStmt->rowCount() > 0) {
        die("Email already registered.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $success = $stmt->execute([$name, $email, $hashedPassword]);

    if ($success) {
        echo "Registration successful.";
        // header("Location: login.php?registered=1");
        // exit;
    } else {
        echo "Something went wrong. Please try again.";
    }
}
?>
