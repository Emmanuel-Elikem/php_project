<?php
require_once 'config/database.php';

$post_id = $_GET['id'];

// Get post details
$sql = "SELECT posts.*, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        WHERE posts.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$post_id]);
$post = $stmt->fetch();

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];
    
    $sql = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id, $user_id, $comment]);
}

// Get all comments
$sql = "SELECT comments.*, users.username 
        FROM comments 
        JOIN users ON comments.user_id = users.id 
        WHERE post_id = ? 
        ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$post_id]);
$comments = $stmt->fetchAll();

include 'includes/header.php';
?>

<h1><?php echo htmlspecialchars($post['title']); ?></h1>
<p>By <?php echo htmlspecialchars($post['username']); ?></p>
<p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

<h3>Comments</h3>
<?php if(isset($_SESSION['user_id'])): ?>
    <form method="POST">
        <textarea name="comment" placeholder="Write a comment..." required></textarea>
        <button type="submit">Post Comment</button>
    </form>
<?php endif; ?>

<?php foreach($comments as $comment): ?>
    <div style="border: 1px solid #eee; padding: 10px; margin: 10px 0;">
        <strong><?php echo htmlspecialchars($comment['username']); ?>:</strong>
        <p><?php echo htmlspecialchars($comment['comment']); ?></p>
    </div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>