<?php
include("db.php"); // database connection

// Function to check if user already exists
function userExists($conn, $username, $email) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return ($result->num_rows > 0);
}

// Function to register a new user
function registerUser($conn, $username, $email, $password) 
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES ( ?, ?, ?)");
    $stmt->bind_param("sss",$username, $email, $hashedPassword);
    return $stmt->execute();
    }



// Main registration logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);
    $cpassword  = trim($_POST['cpassword']);

    if ($password !== $cpassword) {
        echo "❌ Passwords do not match!";
    } elseif (userExists($conn, $username, $email)) {
        echo "⚠️ Username or Email already exists!";
    } elseif (registerUser($conn, $username, $email, $password)) {
        echo "✅ Registration successful!";
    } else {
        echo "❌ Something went wrong. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
<a href ="login.html">Back to Login</a>    
</body>
</html>