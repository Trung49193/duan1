<!-- views/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h2>Welcome to Home Page</h2>
    <?php 
    if (isUserLoggedIn()) {
        echo "<p>Hello, " . htmlspecialchars($_SESSION['user']) . "!</p>";
        echo "<a href='?action=logout'>Logout</a>";
    } else {
        echo "<p>Please <a href='?action=login'>login</a> or <a href='?action=register'>register</a>.</p>";
    }
    ?>
</body>
</html>