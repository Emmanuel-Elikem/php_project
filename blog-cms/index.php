<?php
require_once 'config/database.php';

// Get all posts with author names
$sql = "SELECT posts.*, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll();

include 'includes/header.php';
?>

<h1>Blog Posts</h1>

<?php foreach($posts as $post): ?>
    <div class="post">
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p>By <?php echo htmlspecialchars($post['username']); ?> 
           on <?php echo $post['created_at']; ?></p>
        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        <a href="post.php?id=<?php echo $post['id']; ?>">Read More & Comments</a>
        
        <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
            <a href="edit-post.php?id=<?php echo $post['id']; ?>">Edit</a>
            <a href="delete-post.php?id=<?php echo $post['id']; ?>" 
               onclick="return confirm('Delete this post?')">Delete</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>