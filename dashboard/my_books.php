<?php
session_start();
require_once "../config/db.php";
require_once "../auth/auth_check.php";

$userId = $_SESSION['user_id'];

// Get purchased books
$stmt = $pdo->prepare("SELECT books.id, books.title, books.author, books.file_path 
                       FROM purchases 
                       JOIN books ON purchases.book_id = books.id 
                       WHERE purchases.user_id = ?");
$stmt->execute([$userId]);
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Books</title>
</head>
<body>
    <h1>My Purchased Books</h1>

    <?php if ($books): ?>
        <ul>
            <?php foreach ($books as $book): ?>
                <li>
                    <strong><?php echo htmlspecialchars($book['title']); ?></strong> by 
                    <?php echo htmlspecialchars($book['author']); ?>
                    - <a href="download_book.php?id=<?php echo $book['id']; ?>">Download</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>You haven't purchased any books yet.</p>
    <?php endif; ?>

    <p><a href="dashboard.php">⬅ Back to Dashboard</a></p>
</body>
</html>
