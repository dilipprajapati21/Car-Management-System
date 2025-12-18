<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT email, password FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($email, $hashedpassword);
        $stmt->fetch();

        if (password_verify($password, $hashedpassword)) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email; // save email in session
            header("Location: redirectHome.html"); // redirect to order page
            exit();
        } else {
            echo "<script>alert('Invalid credentials'); window.location='login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials'); window.location='login.html';</script>";
    }
    $stmt->close();
}
?>
