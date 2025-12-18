<?php
session_start();
include('db.php'); 

if(!isset($_SESSION['username'])){
    echo "<script>alert('Please login first!'); window.location='login.html';</script>";
    exit;
}

$username = $_SESSION['username'];

// Fetch user details
$stmt = $conn->prepare("SELECT id, username, email FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(!$user){
    echo "<script>alert('User not found!'); window.location='logout.php';</script>";
    exit;
}

// Fixed default profile picture for all users
$default_profile_pic = 'car1.jpg'; // <-- place your default image here

// Handle form submission
if(isset($_POST['update'])){
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE username=?");
    $stmt->bind_param("sss", $new_username, $new_email, $username);

    if($stmt->execute()){
        $_SESSION['username'] = $new_username; // update session
        echo "<script>alert('Profile updated successfully!'); window.location='my-profile.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profile</title>
<style>
body{font-family:'Poppins', sans-serif;background:#ECEFF1;margin:0;}
.container{display:flex;min-height:100vh;}
.sidebar{width:220px;background:#1A237E;color:#FFC107;padding-top:30px;text-align:center;border-radius:0 15px 15px 0;box-shadow:4px 0 15px rgba(0,0,0,0.1);}
.sidebar h4{margin-bottom:20px;font-size:22px;}
.sidebar img{width:120px;height:120px;border-radius:50%;object-fit:cover;margin-bottom:20px;border:3px solid #FFC107;}
.sidebar a{display:block;color:#FFC107;text-decoration:none;padding:12px;margin:8px 20px;border-radius:5px;font-weight:bold;transition:0.3s;}
.sidebar a:hover{background:#EF6C00;color:#fff;}
.profile-content{flex-grow:1;padding:40px;background:#fff;margin:20px;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,0.05);}
.profile-content h2{margin-bottom:30px;color:#1A237E;}
.profile-content label{display:block;margin:10px 0 5px;font-weight:bold;}
.profile-content input[type="text"], input[type="email"]{width:100%;padding:10px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px;}
.profile-content button{background:#FFC107;color:#1A237E;padding:12px 25px;border:none;border-radius:5px;font-weight:bold;cursor:pointer;transition:0.3s;}
.profile-content button:hover{background:#EF6C00;color:#fff;}
@media(max-width:768px){.container{flex-direction:column;}.sidebar{width:100%;padding-bottom:20px;}}
</style>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <h4>Edit Profile</h4>
        <img src="<?= $default_profile_pic ?>" alt="Profile Pic">
        <a href="my-profile.php">Back to Profile</a>
        <a href="change-password.php">Change Password</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="profile-content">
        <h2>Edit Your Profile</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>

            <button type="submit" name="update">Update Profile</button>
        </form>
    </div>
</div>

</body>
</html>
