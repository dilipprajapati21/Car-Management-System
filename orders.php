<?php
session_start();
include("db.php");

// check login
if (!isset($_SESSION['email'])) {
    echo "<script>alert('Please login first!'); window.location='login.html';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $car = $_POST['car'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    $email = $_SESSION['email'];

    $stmt = $conn->prepare("INSERT INTO orders (fullname, email, phone, car, address, payment, order_date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssss", $fullname, $email, $phone, $car, $address, $payment);
    if ($stmt->execute()) {
        echo "<script>alert('Order placed!'); window.location='bill.php';</script>";
    } else {
        echo "<script>alert('Failed to place order');</script>";
    }
    $stmt->close();
}
?>
<!-- Simple HTML form -->
<form method="POST">
<input type="text" name="fullname" placeholder="Full Name" required>
<input type="text" name="phone" placeholder="Phone" required>
<input type="text" name="car" placeholder="Car Model" required>
<input type="text" name="address" placeholder="Address" required>
<select name="payment" required>
<option value="Cash">Cash</option>
<option value="UPI">UPI</option>
<option value="Card">Card</option>
</select>
<button type="submit">Place Order</button>
</form>
