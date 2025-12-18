<?php
include 'db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

// Handle Approve/Delete actions
if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE bookings SET status='Approved' WHERE id=$id");
}
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM bookings WHERE id=$id");
}

// Fetch all bookings
$sql = "SELECT * FROM bookings ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Carz World</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f2f5;
    margin: 0; padding: 0;
}
nav {
    background: #0F172A;
    color: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
}
nav a {
    color: white;
    margin-left: 15px;
    text-decoration: none;
    font-weight: 500;
}
nav a:hover {
    color: #3B82F6;
}
.container {
    max-width: 1200px;
    margin: 40px auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}
.card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}
.card h3 {
    margin: 0;
    color: #1E40AF;
}
.card p {
    margin: 5px 0;
    color: #334155;
    font-size: 14px;
}
.card .status {
    font-weight: bold;
    margin: 10px 0;
}
.btn {
    padding: 8px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-size: 14px;
    font-weight: 500;
    display: inline-block;
    margin-top: 5px;
    transition: 0.3s;
}
.approve {
    background: #10B981;
}
.approve:hover {
    background: #059669;
}
.delete {
    background: #EF4444;
}
.delete:hover {
    background: #B91C1C;
}
</style>
</head>
<body>

<nav>
    <div>🚗 Carz World - Admin</div>
    <div>
        <a href="home.html">Home</a>
        <a href="admin-dashboard.php">Dashboard</a>
        <a href="addminBook.php">Bookings</a>
        <a href="adminlogout.php">Logout</a>
    </div>
</nav>

<div class="container">
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<h3>'.htmlspecialchars($row['name']).'</h3>';
        echo '<p><strong>Email:</strong> '.htmlspecialchars($row['email']).'</p>';
        echo '<p><strong>Phone:</strong> '.htmlspecialchars($row['phone']).'</p>';
        echo '<p><strong>Car:</strong> '.htmlspecialchars($row['car']).'</p>';
        echo '<p><strong>Date:</strong> '.$row['booking_date'].'</p>';
        echo '<p><strong>Message:</strong> '.htmlspecialchars($row['message']).'</p>';
        echo '<p class="status"><strong>Status:</strong> '.$row['status'].'</p>';
        echo '<div>';
        // Only show approve button if not approved
        if($row['status'] != 'Approved'){
            echo '<a href="addminBook.php?approve='.$row['id'].'" class="btn approve">Approve</a>';
        }
        echo '<a href="addminBook.php?delete='.$row['id'].'" class="btn delete" onclick="return confirm(\'Are you sure?\')">Delete</a>';
        echo '</div></div>';
    }
} else {
    echo "<p style='grid-column: 1/-1; text-align:center; color:#334155;'>No bookings yet</p>";
}
$conn->close();
?>
</div>

</body>
</html>
