<?php
include 'db.php'; // Connect to your database

$results = [];
$searchTerm = "";

if (isset($_GET['query']) && trim($_GET['query']) !== '') {
    $searchTerm = trim($_GET['query']);
    $query = "%" . $searchTerm . "%";

    // Search in name, engine, and description columns
    $sql = "SELECT * FROM cars WHERE name LIKE ? OR engine LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $query, $query, $query);
    $stmt->execute();
    $results = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Search Cars | Carz World</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 800px;
      margin: auto;
    }
    h1 {
      text-align: center;
      color: navy;
      margin-bottom: 30px;
    }
    form {
      text-align: center;
      margin-bottom: 40px;
    }
    input[type="text"] {
      padding: 10px;
      width: 60%;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    button {
      padding: 10px 20px;
      background-color: navy;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-left: 10px;
    }
    button:hover {
      background-color: #004080;
    }
    .car-card {
      background: white;
      padding: 20px;
      margin-bottom: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .car-card img {
      width: 100%;
      max-height: 500px;
      object-fit: cover;
      border-radius: 8px;
      margin-top: 10px;
    }
    .btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 16px;
      background-color: navy;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.2s ease;
    }
    .btn:hover {
      background-color: #003366;
    }
    .no-results {
      text-align: center;
      color: red;
      font-weight: bold;
      font-size: 18px;
    }
    h2 {
      color: #333;
      margin-bottom: 20px;
    }
    p {
      margin: 5px 0;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Search Cars</h1>

  <form method="GET" action="search.php">
    <input 
      type="text" 
      name="query" 
      placeholder="Search by name, engine, or description" 
      value="<?= htmlspecialchars($searchTerm) ?>" 
      required
    >
    <button type="submit">Search</button>
  </form>

  <?php if (isset($_GET['query'])): ?>
    <h2>Results for: "<?= htmlspecialchars($searchTerm) ?>"</h2>

    <?php if ($results && $results->num_rows > 0): ?>
      <?php while ($row = $results->fetch_assoc()): ?>
        <div class="car-card">
          <h3><?= htmlspecialchars($row['name']) ?></h3>
          <p><strong>Engine:</strong> <?= htmlspecialchars($row['engine']) ?></p>
          <p><strong>Mileage:</strong> <?= htmlspecialchars($row['mileage']) ?></p>
          <p><strong>Price:</strong> <?= htmlspecialchars($row['price']) ?></p>
          <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
          <?php if (!empty($row['image'])): ?>
            <!-- Assuming images are stored in an "images" folder -->
            <img src="car1.jpg">
          <?php else: ?>
            <p><em>No image available.</em></p>
          <?php endif; ?>
          <a class="btn" href="cardetail.html">View Details</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="no-results">❌ No cars found matching your search.</p>
    <?php endif; ?>
  <?php endif; ?>

</div>

</body>
</html>
