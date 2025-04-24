<?php
session_start();
require_once "../config/db.php";
require_once "../auth/auth_check.php";

if (!isset($_GET['id'])) {
    die("No book ID specified.");
}

$bookId = $_GET['id'];
$userId = $_SESSION['user_id'];

// Verifying the user purchased this book
$stmt = $pdo->prepare("SELECT books.file_path 
                       FROM purchases 
                       JOIN books ON purchases.book_id = books.id 
                       WHERE purchases.user_id = ? AND purchases.book_id = ?");
$stmt->execute([$userId, $bookId]);
$book = $stmt->fetch();

if ($book) {
    $filePath = "../books/uploads/" . $book['file_path'];
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "You are not authorized to download this book.";
}
