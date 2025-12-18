<?php
session_start();

// If user not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username']; // get logged in username
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard - Carz World</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f4f6f9;
    }
    /* Navbar */
    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #0a2e63;
      color: white;
      padding: 15px 40px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
    }
    nav .logo {
      font-size: 20px;
      font-weight: bold;
    }
    nav ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }
    nav ul li {
      margin-left: 20px;
    }
    nav ul li a {
      text-decoration: none;
      color: white;
      font-weight: bold;
      padding: 6px 12px;
      border-radius: 6px;
      transition: 0.3s;
    }
    nav ul li a:hover {
      background: #ffcc00;
      color: #000;
    }
    /* Profile dropdown */
    .profile {
      position: relative;
      display: inline-block;
    }
    .profile-btn {
      background: #ffcc00;
      color: #000;
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }
    .dropdown {
      display: none;
      position: absolute;
      right: 0;
      background: white;
      min-width: 150px;
      box-shadow: 0px 8px 20px rgba(0,0,0,0.3);
      border-radius: 6px;
      overflow: hidden;
    }
    .dropdown a {
      display: block;
      padding: 10px;
      color: #333;
      text-decoration: none;
      transition: 0.3s;
    }
    .dropdown a:hover {
      background: #f1f1f1;
    }
    .profile:hover .dropdown {
      display: block;
    }
    /* Dashboard content */
    .container {
      padding: 50px;
      text-align: center;
    }
    .home-box {
      background: white;
      padding: 40px;
      border-radius: 15px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
    }
    .home-box h1 {
      color: #0a2e63;
    }
    .home-box p {
      color: #555;
      font-size: 18px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav>
    <div class="logo">🚘 Carz World</div>
    <ul>
      <li><a href="redirectHome.html">Home</a></li>
      <li><a href="sparepart.html">Services</a></li>
      <li><a href="about.html">About</a></li>
    </ul>
    <div class="profile">
      <button class="profile-btn"><?php echo "profile"; ?> ⬇</button>
      <div class="dropdown">
        <a href="my-profile.php">My Profile</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Dashboard Home -->
  <div class="container">
    <div class="home-box">
      <h1>Welcome, <?php echo $username; ?> 👋</h1>
      <p>This is your Carz World dashboard. From here, you can explore our services, manage your profile, and much more.</p>
    </div>
  </div>

</body>
</html>