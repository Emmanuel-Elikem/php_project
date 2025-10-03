<?php
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$post_id = $_GET['id'];

$sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$post_id, $_SESSION['user_id']]);

header('Location: index.php');
?>