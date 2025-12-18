<?php
// Database configuration
$host = "localhost";   // XAMPP default host
$user = "root";        // XAMPP default username
$pass = "";            // XAMPP default password (empty by default)
$dbname = "carzworld11"; // Your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} else {
    // echo "✅ Database connected successfully!";
}
?>