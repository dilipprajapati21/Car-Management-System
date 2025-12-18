<?php
include 'db.php'; // include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $car      = $_POST['car'];
    $date     = $_POST['date'];
    $message  = $_POST['message'];

    // Prepare & Insert
    $sql = "INSERT INTO bookings (name, email, phone, car, booking_date, message) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $car, $date, $message);

    if ($stmt->execute()) {
        echo "<h2>✅ Booking Successful!</h2>";
        echo "<p>Thank you, $name. Your $car is booked for $date.</p>";
        echo "<a href='rental-car.html'>Go Back </a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>