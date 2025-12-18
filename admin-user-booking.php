<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
include 'db.php';

if(!isset($_GET['email'])) die("Invalid request");

$user_email = $_GET['email'];
$stmt = $conn->prepare("SELECT * FROM bookings WHERE email=? ORDER BY created_at DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Orders | Carz World Admin</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f6f9; margin:0; }
.navbar { background: navy; color:white; padding:15px 30px; display:flex; justify-content:space-between; }
.navbar a { color:white; margin-left:15px; text-decoration:none; }
.container { max-width:1100px; margin:40px auto; background:white; padding:30px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.2); }
h2 { color:navy; text-align:center; margin-bottom:20px; }
table { width:100%; border-collapse: collapse; margin-top:20px; }
th, td { border:1px solid #ccc; padding:10px; text-align:center; }
th { background: navy; color:white; }
tr:nth-child(even) { background: #f9f9f9; }
.btn { padding:6px 12px; border-radius:5px; text-decoration:none; color:white; background:green; display:inline-block; }
</style>
</head>
<body>

<div class="navbar">
  <div>🚗 Carz World - Admin</div>
  <div>
    <a href="admin-dashboard.php">Dashboard</a>
    <a href="admin-user-summary.php">User Summary</a>
    <a href="logout.php">Logout</a>
  </div>
</div>

<div class="container">
<h2>Bookings of <?= htmlspecialchars($user_email) ?></h2>
<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Phone</th>
  <th>Car</th>
  <th>Booking Date</th>
  <th>Message</th>
  <th>Status</th>
  <th>Download Bill</th>
</tr>

<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".htmlspecialchars($row['name'])."</td>
                <td>".htmlspecialchars($row['phone'])."</td>
                <td>".htmlspecialchars($row['car'])."</td>
                <td>".$row['booking_date']."</td>
                <td>".htmlspecialchars($row['message'])."</td>
                <td>".htmlspecialchars($row['status'])."</td>
                <td><a class='btn' href='bill-generate.php?id=".$row['id']."'>Download</a></td>
              </tr>";
    }
}else{
    echo "<tr><td colspan='8'>No bookings found for this user</td></tr>";
}
$conn->close();
?>
</table>
</div>

</body>
</html>
