<?php
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$post_id = $_GET['id'];

// Get postS
$sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$post_id, $_SESSION['user_id']]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found or you don't have permission!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $content, $post_id]);
    
    header('Location: index.php');
}

include 'includes/header.php';
?>

<h2>Edit Post</h2>
<form method="POST">
    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
    <textarea name="content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>
    <button type="submit">Update Post</button>
</form>

<?php include 'includes/footer.php'; ?>