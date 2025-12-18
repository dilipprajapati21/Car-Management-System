<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit();
}

include 'db.php';

// Fetch all orders
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Orders | Carz World</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }
      .navbar {
      background: navy;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
    }
    .navbar h1 {
      margin: 0;
      font-size: 20px;
    }
    .nav-links a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-size: 16px;
      padding: 6px 12px;
      border-radius: 5px;
      transition: 0.3s;
    }
    .nav-links a:hover {
      background: white;
      color: navy;
    }
    .container {
      max-width: 1000px;
      margin: 40px auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    h2 {
      color: navy;
      margin-bottom: 20px;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th {
      background: navy;
      color: white;
      padding: 10px;
    }
    td {
      padding: 10px;
      text-align: center;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }
    .btn {
      display: inline-block;
      padding: 6px 12px;
      background: crimson;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-size: 14px;
    }
    .btn:hover {
      background: darkred;
    }
  </style>
</head>
<body>

<div class="navbar">
  <h1>Carz World - Admin Dashboard</h1>
  <div class="nav-links">
    <a href="admin-dashboard.php">Dashboard</a>
  </div>

</div>

<div class="container">
  <h2>Customer Orders</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Car</th>
      <th>Address</th>
      <th>Payment</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['fullname']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= htmlspecialchars($row['phone']) ?></td>
      <td><?= htmlspecialchars($row['car']) ?></td>
      <td><?= htmlspecialchars($row['address']) ?></td>
      <td><?= htmlspecialchars($row['payment']) ?></td>
      <td><?= $row['order_date'] ?></td>
      <td>
        <a href="delete-order.php?id=<?= $row['id'] ?>" class="btn" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

</body>
</html>