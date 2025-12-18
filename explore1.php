<?php
include 'db.php';
$sql = "SELECT * FROM cars ";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Explore Cars - Carz World</title>
</head>
<body>
  <h2>Explore Cars</h2>
  <div>
    <?php
    if ($result->num_rows > 0) {
        while($car = $result->fetch_assoc()) {
            echo "<div style='border:1px solid #ccc; padding:10px; margin:10px;'>
                    <img src='uploads/".$car['image']."' width='200'><br>
                    <h3>".$car['name']."</h3>
                    <p>".$car['price']."</p>
                    <a href='car-details.php?id=".$car['id']."'>View Details</a>
                  </div>";
        }
    } else {
        echo "<p>No cars available.</p>";
    }
    ?>
  </div>
</body>
</html>