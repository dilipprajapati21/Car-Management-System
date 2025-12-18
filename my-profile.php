<?php
session_start();
include('db.php'); 

// Check login
if(!isset($_SESSION['username']) || !isset($_SESSION['email'])){
    echo "<script>alert('Please login first!'); window.location='login.html';</script>";
    exit;
}

$username = $_SESSION['username'];
$user_email = $_SESSION['email'];

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

// Default profile picture
$default_profile_pic = 'car1.jpg';

// Fetch bookings for this user from orders table
$stmt2 = $conn->prepare("SELECT * FROM orders WHERE email=? ORDER BY order_date DESC");
$stmt2->bind_param("s", $user_email);
$stmt2->execute();
$orders = $stmt2->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile - Carz World</title>
<style>
body{font-family:'Poppins',sans-serif;background:#ECEFF1;margin:0;}
.container{display:flex;min-height:100vh;}
.sidebar{width:220px;background:#1A237E;color:#FFC107;padding:30px 15px;text-align:center;border-radius:0 15px 15px 0;box-shadow:4px 0 15px rgba(0,0,0,0.1);}
.sidebar h4{margin-bottom:20px;font-size:22px;}
.sidebar img{width:120px;height:120px;border-radius:50%;object-fit:cover;margin-bottom:20px;border:3px solid #FFC107;}
.sidebar a{display:block;color:#FFC107;text-decoration:none;padding:12px 0;margin:8px 0;font-weight:600;border-radius:8px;transition:0.3s;}
.sidebar a:hover{background-color:#EF6C00;color:#fff;}
.profile-content{flex-grow:1;padding:50px;background:#fff;margin:20px;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,0.05);}
.profile-content h2{margin-bottom:30px;color:#1A237E;font-size:28px;}
.info{background:#f7f9fb;padding:20px 25px;margin-bottom:20px;border-radius:15px;border-left:5px solid #FFC107;transition:0.3s;}
.info:hover{background:#FFF3E0;}
.label{font-weight:600;color:#555;}
.value{display:block;color:#212121;margin-top:8px;font-size:18px;}
table{width:100%;border-collapse:collapse;margin-top:20px;}
th,td{border:1px solid #ccc;padding:10px;text-align:center;}
th{background:#1A237E;color:#FFC107;}
tr:nth-child(even){background:#f7f7f7;}
.download-btn{background:#4CAF50;color:white;padding:6px 12px;border-radius:5px;text-decoration:none;}
@media(max-width:768px){.container{flex-direction:column;}.sidebar{width:100%;border-radius:0;display:flex;justify-content:space-around;padding:15px 0;}.sidebar h4,.sidebar img{display:none;}.profile-content{margin:10px;padding:30px 20px;}}
</style>
</head>
<body>

<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>My Profile</h4>
        <img src="<?= $default_profile_pic ?>" alt="Profile Pic">
        <a href="edit_profile.php">Edit Profile</a>
        <a href="forgot-password.php">Forgot Password</a>
        <a href="change-password.php">Change Password</a>
        <a href="redirectHome.html">Back To Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="profile-content">
        <h2>Welcome, <?= htmlspecialchars($user['username']); ?></h2>

        <div class="info">
            <span class="label">Username:</span>
            <span class="value"><?= htmlspecialchars($user['username']); ?></span>
        </div>
        <div class="info">
            <span class="label">Email:</span>
            <span class="value"><?= htmlspecialchars($user['email']); ?></span>
        </div>
        <div class="info">
            <span class="label">Password:</span>
            <span class="value">••••••••</span>
        </div>

        <h2 style="margin-top:40px;">My Orders</h2>
        <?php if($orders->num_rows > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Car</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Payment</th>
                    <th>Order Date</th>
                    <th>Download Bill</th>
                </tr>
                <?php while($row = $orders->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['car']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['payment']) ?></td>
                    <td><?= $row['order_date'] ?></td>
                    <td>
                        <a class="download-btn" href="bill-generate.php?id=<?= $row['id'] ?>">Download</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>You have not made any orders yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
