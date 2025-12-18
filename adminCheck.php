<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch admin from DB
    $sql = "SELECT * FROM admins WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if ( $admin['password']) {
            $_SESSION['admin'] = $admin['username'];
            header("Location: admin-dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "❌ Invalid password!";
        }
    } else {
        $_SESSION['error'] = "❌ Admin not found!";
    }

    header("Location: adminlogin.php");
}
?>