<!-- views/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($_GET['error'])) { echo "<p style='color: red;'>".$_GET['error']."</p>"; } ?>
    <?php if (isset($_GET['success'])) { echo "<p style='color: green;'>".$_GET['success']."</p>"; } ?>
    <form method="POST" action="?action=handleLogin">
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="?action=register">Register here</a></p>
</body>
</html>