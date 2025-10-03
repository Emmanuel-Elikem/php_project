<?php
require_once 'config/database.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $hashed_password]);  
        
        header('Location: login.php');  
    } catch(PDOException $e) {
        $error = "Username already exists!";
    }
}

include 'includes/header.php';
?>

<h2>Register</h2>
<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>

<?php include 'includes/footer.php'; ?>