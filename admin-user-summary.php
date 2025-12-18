<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - User Summary | Carz World</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f6f9; margin:0; }
.navbar { background: navy; color:white; padding:15px 30px; display:flex; justify-content:space-between; }
.navbar a { color:white; margin-left:15px; text-decoration:none; }
.container { max-width:1000px; margin:40px auto; background:white; padding:30px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.2); }
h2 { color:navy; text-align:center; margin-bottom:20px; }
table { width:100%; border-collapse: collapse; margin-top:20px; }
th, td { border:1px solid #ccc; padding:10px; text-align:center; }
th { background: navy; color:white; }
tr:nth-child(even) { background: #f9f9f9; }
.btn { padding:6px 12px; border-radius:5px; text-decoration:none; color:white; background:orange; display:inline-block; }
</style>
</head>
<body>

<div class="navbar">
  <div>🚗 Carz World - Admin</div>
  <div>
    <a href="admin-dashboard.php">Dashboard</a>
    <a href="admincars.php">Cars</a>
    <a href="addminBook.php">Bookings</a>
    <a href="logout.php">Logout</a>
  </div>
</div>

<div class="container">
<h2>User Booking Summary</h2>
<table>
<tr>
  <th>Name</th>
  <th>Email</th>
  <th>Total Bookings</th>
  <th>Action</th>
</tr>

<?php
$sql = "SELECT email, name, COUNT(*) AS total_bookings FROM bookings GROUP BY email, name ORDER BY total_bookings DESC";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>".htmlspecialchars($row['name'])."</td>
                <td>".htmlspecialchars($row['email'])."</td>
                <td>".$row['total_bookings']."</td>
                <td><a class='btn' href='admin-user-bookings.php?email=".urlencode($row['email'])."'>View Orders</a></td>
              </tr>";
    }
}else{
    echo "<tr><td colspan='4'>No users found</td></tr>";
}
$conn->close();
?>
</table>
</div>

</body>
</html>
