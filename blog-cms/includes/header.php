<!DOCTYPE html>
<html>
<head>
    <title>Blog CMS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <!-- Show only if user is logged in -->
            <a href="create-post.php">Write Post</a>
            <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
        <?php else: ?>
            <!-- Show if user is NOT logged in -->
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
    <div class="container">