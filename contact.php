<?php
include 'db.php'; // include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $message  = $_POST['message'];

    // Prepare & Insert
    $sql = "INSERT INTO contacts1(name, email, message) 
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<h2>✅ Your Message Added Successfuly!</h2>";
        echo "<p>Thank you, $name.</p>";
        echo "<a href='home.html'>Go Back to Home</a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>