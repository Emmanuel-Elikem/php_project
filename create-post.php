<?php
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    
    $sql = "INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $content, $user_id]);
    
    header('Location: index.php');
}

include 'includes/header.php';
?>

<h2>Create New Post</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Post Title" required>
    <textarea name="content" rows="10" placeholder="Write your post..." required></textarea>
    <button type="submit">Publish Post</button>
</form>

<?php include 'includes/footer.php'; ?>