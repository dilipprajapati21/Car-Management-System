<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Carz World</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #ECEFF1, #CFD8DC);
    }
    .login-box {
      background: white;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.2);
      width: 350px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .login-box::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: rgba(255, 193, 7, 0.05);
      transform: rotate(45deg);
      pointer-events: none;
    }
    .login-box h2 {
      color: #1A237E;
      font-size: 28px;
      margin-bottom: 25px;
      font-weight: 700;
      letter-spacing: 1px;
    }
    input {
      width: 100%;
      padding: 12px;
      margin: 12px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
      transition: border 0.3s;
    }
    input:focus {
      border-color: #1A237E;
      outline: none;
    }
    .btn {
      width: 100%;
      padding: 12px;
      background: #1A237E;
      color: #FFC107;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s, color 0.3s, transform 0.2s;
    }
    .btn:hover {
      background: #FFC107;
      color: #1A237E;
      transform: translateY(-2px);
    }
    .error {
      color: red;
      margin-bottom: 15px;
      font-weight: 600;
    }
    @media (max-width: 400px) {
      .login-box { width: 90%; padding: 30px 20px; }
      .login-box h2 { font-size: 24px; }
      input, .btn { font-size: 15px; padding: 10px; }
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Admin Login</h2>
  <?php
  if (isset($_SESSION['error'])) {
      echo "<p class='error'>" . $_SESSION['error'] . "</p>";
      unset($_SESSION['error']);
  }
  ?>
  <form action="adminCheck.php" method="POST">
    <input type="text" name="username" placeholder="Enter Username" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit" class="btn">Login</button>
  </form>
</div>

</body>
</html>
