<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Home Page</h1>
    <p>Welcome, <b><?php echo $_SESSION['username']; ?></b></p>
    
</body>
</html>