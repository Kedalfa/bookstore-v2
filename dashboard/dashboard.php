<?php
session_start();
require_once "../config/db.php";
require_once "../auth/auth_check.php";

$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard, <?php echo $_SESSION['user_name']; ?>!</h1>

    <p><a href="my_books.php">📚 My Purchased Books</a></p>
    <p><a href="../cart/checkout.php">🛒 Go to Checkout</a></p>
    <p><a href="../auth/logout.php">🚪 Logout</a></p>
</body>
</html>
