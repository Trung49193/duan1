<!-- views/register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($_GET['error'])) { echo "<p style='color: red;'>".$_GET['error']."</p>"; } ?>
    <form method="POST" action="?action=handleRegister">
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="?action=login">Login here</a></p>
</body>
</html>