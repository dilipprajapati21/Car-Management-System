<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
include 'db.php';

// Get car ID
if (!isset($_POST['id'])) {
    die("Car ID not provided!");
}
$id = $_POST['id'];

// Fetch existing car data
$sql = "SELECT * FROM cars WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();

if (!$car) {
    die("Car not found!");
}

// Update car
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $engine = $_POST['engine'];
    $mileage = $_POST['mileage'];
    $description = $_POST['description'];

    // Image update check
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $car['image']; // keep old image
    }

    $sql = "UPDATE cars SET name=?, price=?, engine=?, mileage=?, description=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $price, $engine, $mileage, $description, $image, $id);

    if ($stmt->execute()) {
        header("Location: admincars.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Car</title>
</head>
<body>
  <h2>Edit Car</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Car Name:</label><br>
    <input type="text" name="name" value="<?= $car['name'] ?>" required><br><br>

    <label>Price:</label><br>
    <input type="text" name="price" value="<?= $car['price'] ?>" required><br><br>

    <label>Engine:</label><br>
    <input type="text" name="engine" value="<?= $car['engine'] ?>"><br><br>

    <label>Mileage:</label><br>
    <input type="text" name="mileage" value="<?= $car['mileage'] ?>"><br><br>

    <label>Description:</label><br>
    <textarea name="description"><?= $car['description'] ?></textarea><br><br>

    <label>Current Image:</label><br>
    <img src="uploads/<?= $car['image'] ?>" width="150"><br><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Update Car</button>
  </form>
</body>
</html>