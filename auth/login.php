<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check for empty input
    if (empty($email) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Fetch user by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Valid login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        echo "Login successful.";
        // header("Location: ../dashboard/dashboard.php");
        // exit;
    } else {
        echo "Invalid email or password.";
    }
}
?>
