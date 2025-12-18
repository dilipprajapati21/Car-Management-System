<?php
session_start();
include('db.php');

$email = "";

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in first!'); window.location='login.html';</script>";
    exit;
} else {
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT email FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $email = $user['email'];
    } else {
        echo "<script>alert('User not found!'); window.location='logout.php';</script>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = trim($_POST['new_password']);

    if (empty($new_password)) {
        $error = "Please enter a new password.";
    } else {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET password=? WHERE email=?");
        $update->bind_param("ss", $hashed, $email);
        $update->execute();

        echo "<script>alert('Password successfully reset! Please login again.'); window.location='logout.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f5f5;
      padding: 50px;
    }
    .box {
      max-width: 400px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #1A237E;
    }
    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    input[readonly] {
      background-color: #eee;
    }
    button {
      width: 100%;
      padding: 12px;
      background: #1A237E;
      color: white;
      border: none;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #3949AB;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<div class="box">
  <h2>Reset Password</h2>
  <?php if (isset($error)): ?>
    <div class="error"><?= htmlspecialchars($error); ?></div>
  <?php endif; ?>
  <form method="post">
    <label>Email:</label>
    <input type="email" value="<?= htmlspecialchars($email); ?>" readonly>

    <label>New Password:</label>
    <input type="password" name="new_password" required>

    <button type="submit">Reset Password</button>

    
  </form>
</div>

<a href="my-profile.php"><center>back</center></a>

</body>
</html>
