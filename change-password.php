<?php
session_start();
include('db.php'); 

if(!isset($_SESSION['username'])){
    echo "<script>alert('Please login first!'); window.location='login.html';</script>";
    exit;
}

$username = $_SESSION['username'];

// Handle password change form submission
if(isset($_POST['change_password'])){
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch current hashed password
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if(!$user){
        echo "<script>alert('User not found!'); window.location='logout.php';</script>";
        exit;
    }

    // Verify current password
    if(!password_verify($current_password, $user['password'])){
        echo "<script>alert('Current password is incorrect!');</script>";
    } 
    elseif($new_password !== $confirm_password){
        echo "<script>alert('New password and confirm password do not match!');</script>";
    } 
    else {
        // Hash new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
        $stmt->bind_param("ss", $hashed_password, $username);

        if($stmt->execute()){
            echo "<script>alert('Password changed successfully!'); window.location='my-profile.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to update password.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>
<style>
body{font-family:'Poppins', sans-serif;background:#ECEFF1;margin:0;}
.container{display:flex;min-height:100vh;}
.sidebar{width:220px;background:#1A237E;color:#FFC107;padding-top:30px;text-align:center;border-radius:0 15px 15px 0;box-shadow:4px 0 15px rgba(0,0,0,0.1);}
.sidebar h4{margin-bottom:20px;font-size:22px;}
.sidebar img{width:120px;height:120px;border-radius:50%;object-fit:cover;margin-bottom:20px;border:3px solid #FFC107;}
.sidebar a{display:block;color:#FFC107;text-decoration:none;padding:12px;margin:8px 20px;border-radius:5px;font-weight:bold;transition:0.3s;}
.sidebar a:hover{background:#EF6C00;color:#fff;}
.content{flex-grow:1;padding:40px;background:#fff;margin:20px;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,0.05);}
.content h2{margin-bottom:30px;color:#1A237E;}
.content label{display:block;margin:10px 0 5px;font-weight:bold;}
.content input[type="password"]{width:100%;padding:10px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px;}
.content button{background:#FFC107;color:#1A237E;padding:12px 25px;border:none;border-radius:5px;font-weight:bold;cursor:pointer;transition:0.3s;}
.content button:hover{background:#EF6C00;color:#fff;}
@media(max-width:768px){.container{flex-direction:column;}.sidebar{width:100%;padding-bottom:20px;}}
</style>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <h4>Change Password</h4>
        <img src="car1.jpg" alt="Profile Pic">
        <a href="my-profile.php">Back to Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Change Your Password</h2>
        <form method="POST">
            <label>Current Password:</label>
            <input type="password" name="current_password" required>

            <label>New Password:</label>
            <input type="password" name="new_password" required>

            <label>Confirm New Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit" name="change_password">Update Password</button>
        </form>
    </div>
</div>

</body>
</html>
