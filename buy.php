<?php
include 'db.php'; // database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$id=$_GET['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $car = $_POST['car'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];

    // Insert order into DB
    $sql = "INSERT INTO orders (fullname, email, phone, car, address, payment) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fullname, $email, $phone, $car, $address, $payment);

    if ($stmt->execute()) {
        echo "
        <html>
        <head>
            <title>Order Successful</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background: #f4f6f9;
                    text-align: center;
                    padding: 50px;
                }
                .box {
                    background: white;
                    padding: 30px;
                    border-radius: 10px;
                    max-width: 500px;
                    margin: auto;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                }
                h2 {
                    color: navy;
                }
                .btn {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 12px 20px;
                    background: navy;
                    color: white;
                    border: none;
                    border-radius: 6px;
                    text-decoration: none;
                }
                .btn:hover {
                    background: #004080;
                }
            </style>
        </head>
        <body>
            <div class='box'>
                <h2>✅ Order Successful!</h2>
                <p>Thank you, <b>$fullname</b>. Your order for <b>$car</b> has been placed successfully.</p>
                <p>We will contact you soon at <b>$email</b> or <b>$phone</b>.</p>
                <a href='download-bill.php' class='btn'>Download Bill</a>
                <a href='redirectHome.html' class='btn'>Back to Explore</a>
            </div>
        </body>
        </html>
        ";
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>