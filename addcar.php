<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $engine = $_POST['engine'];
    $mileage = $_POST['mileage'];
    $description = $_POST['description'];

    // Upload image
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO cars (name, price, engine, mileage, description, image)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $price, $engine, $mileage, $description, $image);

    if ($stmt->execute()) {
        header("Location: admincars.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Car</title>
</head>
<body>
  <h2>Add New Car</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Car Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Price:</label><br>
    <input type="text" name="price" required><br><br>

    <label>Engine:</label><br>
    <input type="text" name="engine"><br><br>

    <label>Mileage:</label><br>
    <input type="text" name="mileage"><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Upload Image:</label><br>
    <input type="file" name="image" required><br><br>

    <button type="submit">Add Car</button>
  </form>
</body>
</html>