<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
include 'db.php';

// Fetch cars
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Cars - Carz World Admin</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f2f5;
    margin:0; padding:0;
}
nav {
    background:#1E3A8A;
    padding:15px 30px;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
}
nav a {
    color:white;
    margin-left:15px;
    text-decoration:none;
    font-weight:500;
}
nav a:hover {
    color:#3B82F6;
}
.container {
    max-width:1200px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 4px 20px rgba(0,0,0,0.1);
}
h2 {
    text-align:center;
    color:#1E40AF;
    margin-bottom:25px;
    font-size:28px;
}
.add {
    background:#10B981;
    color:white;
    padding:10px 20px;
    border-radius:8px;
    display:inline-block;
    margin-bottom:20px;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}
.add:hover {
    background:#059669;
}
table {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
}
th, td {
    padding:12px 15px;
    text-align:center;
    border-bottom:1px solid #ddd;
}
th {
    background:#1E3A8A;
    color:white;
    text-transform:uppercase;
    letter-spacing:0.05em;
}
tr:nth-child(even) {
    background:#f9f9f9;
}
tr:hover {
    background:#e0e7ff;
    transition:0.3s;
}
.btn {
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    color:white;
    font-size:14px;
    font-weight:500;
    display:inline-block;
    margin:2px 0;
    transition:0.3s;
}
.edit {
    background:#F59E0B;
}
.edit:hover {
    background:#B45309;
}
.delete {
    background:#EF4444;
}
.delete:hover {
    background:#B91C1C;
}
img.car-img {
    border-radius:8px;
    max-width:100px;
    transition:0.3s;
}
img.car-img:hover {
    transform:scale(1.1);
}
@media(max-width:768px){
    table, thead, tbody, th, td, tr { display:block; }
    th { position:sticky; top:0; background:#1E3A8A; color:white; }
    td { text-align:right; padding-left:50%; position:relative; }
    td::before {
        content: attr(data-label);
        position:absolute;
        left:15px;
        width:45%;
        padding-left:15px;
        font-weight:bold;
        text-align:left;
    }
}
</style>
</head>
<body>

<nav>
    <div>🚗 Carz World - Admin</div>
    <div>
        <a href="addminBook.php">Bookings</a>
        <a href="admin-dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="container">
    <h2>Manage Cars</h2>
    <a href="addcar.php" class="add">+ Add New Car</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Car Name</th>
            <th>Price</th>
            <th>Engine</th>
            <th>Mileage</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td data-label='ID'>".$row['id']."</td>
                        <td data-label='Car Name'>".htmlspecialchars($row['name'])."</td>
                        <td data-label='Price'>".$row['price']."</td>
                        <td data-label='Engine'>".$row['engine']."</td>
                        <td data-label='Mileage'>".$row['mileage']."</td>
                        <td data-label='Image'><img class='car-img' src='uploads/".$row['image']."'></td>
                        <td data-label='Actions'>
                            <a href='editcar.php?id=".$row['id']."' class='btn edit'>Edit</a>
                            <a href='delete-car.php?id=".$row['id']."' class='btn delete' onclick='return confirm(\"Delete this car?\")'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No cars added yet</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
