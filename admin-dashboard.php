<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
include 'db.php';

$searchName = '';
if(isset($_GET['search']) && $_GET['search'] != ''){
    $searchName = $_GET['search'];
    $stmt = $conn->prepare("SELECT email, fullname, COUNT(*) AS total_orders FROM orders WHERE fullname LIKE ? GROUP BY email, fullname ORDER BY total_orders DESC");
    $like = "%$searchName%";
    $stmt->bind_param("s",$like);
}else{
    $stmt = $conn->prepare("SELECT email, fullname, COUNT(*) AS total_orders FROM orders GROUP BY email, fullname ORDER BY total_orders DESC");
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Carz World</title>
<style>
body { font-family: Arial, sans-serif; background:#f4f6f9; margin:0; }
.navbar { background: navy; color:white; padding:15px 30px; display:flex; justify-content:space-between; align-items:center; }
.navbar a { color:white; margin-left:15px; text-decoration:none; }
.container { max-width:1100px; margin:40px auto; background:white; padding:30px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.2); }
h2 { color:navy; margin-bottom:20px; text-align:center; }
table { width:100%; border-collapse: collapse; margin-top:20px; }
th, td { border:1px solid #ccc; padding:10px; text-align:center; }
th { background: navy; color:white; }
tr:nth-child(even) { background:#f9f9f9; }
.btn { padding:5px 10px; border-radius:5px; text-decoration:none; color:white; display:inline-block; margin:2px; cursor:pointer; }
.btn-view { background:orange; }
.btn-download { background:green; }
.user-orders { display:none; background:#eef; }
.search-form { text-align:center; margin-bottom:20px; }
.search-form input[type="text"] { padding:8px; width:250px; border-radius:5px; border:1px solid #ccc; }
.search-form button { padding:8px 15px; border:none; border-radius:5px; background:navy; color:white; cursor:pointer; }
</style>
<script>
function toggleOrders(id){
    const row = document.getElementById('orders-'+id);
    row.style.display = row.style.display==='table-row'?'none':'table-row';
}
</script>
</head>
<body>

<div class="navbar">
    <div>🚗 Carz World - Admin</div>
    <div>
        <a href="#">Dashboard</a>
        <a href="admincars.php">Cars</a>
        <a href="addminBook.php">Bookings</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
<h2>User Orders Summary</h2>

<div class="search-form">
    <form method="GET">
        <input type="text" name="search" placeholder="Search user by name" value="<?= htmlspecialchars($searchName) ?>">
        <button type="submit">Search</button>
    </form>
</div>

<table>
<tr>
    <th>Full Name</th>
    <th>Email</th>
    <th>Total Orders</th>
    <th>Action</th>
</tr>

<?php
while($user = $result->fetch_assoc()){
    $userEmail = htmlspecialchars($user['email']);
    $userName = htmlspecialchars($user['fullname']);
    $total = $user['total_orders'];
    $uid = md5($userEmail); // unique id for DOM
    echo "<tr>
        <td>$userName</td>
        <td>$userEmail</td>
        <td>$total</td>
        <td><button class='btn btn-view' onclick=\"toggleOrders('$uid')\">View Orders</button></td>
    </tr>";

    // Fetch user's orders
    $stmt2 = $conn->prepare("SELECT * FROM orders WHERE email=? ORDER BY order_date DESC");
    $stmt2->bind_param("s",$user['email']);
    $stmt2->execute();
    $orders = $stmt2->get_result();

    // Inline orders row
    echo "<tr id='orders-$uid' class='user-orders'>
            <td colspan='4'>
            <table style='width:100%; border-collapse: collapse;'>
                <tr style='background:#007BFF; color:white;'>
                    <th>ID</th><th>Car</th><th>Phone</th><th>Order Date</th><th>Address</th><th>Payment</th><th>Download</th>
                </tr>";
    while($o = $orders->fetch_assoc()){
        echo "<tr>
                <td>".$o['id']."</td>
                <td>".htmlspecialchars($o['car'])."</td>
                <td>".htmlspecialchars($o['phone'])."</td>
                <td>".$o['order_date']."</td>
                <td>".nl2br(htmlspecialchars($o['address']))."</td>
                <td>".htmlspecialchars($o['payment'])."</td>
                <td><a class='btn btn-download' href='bill-generate.php?id=".$o['id']."'>Download</a></td>
              </tr>";
    }
    echo "</table></td></tr>";
}
$conn->close();
?>
</table>
</div>

</body>
</html>
