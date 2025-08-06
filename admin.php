
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h2>Purchases</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Card</th>
            <th>Expiry </th>
            <th>CVV</th>
            <th>Items</th>
            <th>Created_at</th>
        </tr>
        <?php
    // Connect to the database
    $servername = "localhost";
    $username = "root"; // Change to your MySQL username
    $password = ""; // Change to your MySQL password
    $dbname = "jewelrystore";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query payments table
    $sql = "SELECT id,name, address, card, expiry, cvv, items, created_at FROM purchases";
    $result = $conn->query($sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    // Counter for serial numbers
    $serialNumber = 1;

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$serialNumber."</td>";
             echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["address"]."</td>";
            echo "<td>".$row["card"]."</td>";
            echo "<td>".$row["expiry"]."</td>";
            echo "<td>".$row["cvv"]."</td>";
            echo "</tr>";
            $serialNumber++; // Increment serial number for next row
        }
    } else {
        echo "<tr><td colspan='8'>No payments found</td></tr>";
    }
    $conn->close();
?>

    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4fa;
      margin: 0;
      padding: 0;
    }
    .banner {
      background: linear-gradient(to right, #4e54c8, #8f94fb);
      color: white;
      padding: 30px 0;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .banner-title {
      margin: 0;
      font-size: 36px;
    }
    .container {
      max-width: 95%;
      margin: 40px auto;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      overflow-y: auto;
      max-height: 80vh;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 900px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
      vertical-align: top;
    }
    th {
      background-color: #ececff;
      color: #333;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .empty {
      text-align: center;
      color: #888;
      font-size: 18px;
      margin-top: 50px;
    }
    .products-list {
      margin: 0;
      padding-left: 20px;
    }
    .products-list li {
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
 

  <div class="container">
    <?php if ($result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Card Number</th>
            <th>Expiry</th>
            <th>CVV</th>
            <th>Items</th>
          </tr>
        </thead>
        <tbody>
          <?php $count = 1; ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <?php
              $items = json_decode($row["items"], true);
              $itemsHTML = "<ul class='products-list'>";
              if (is_array($items)) {
                foreach ($items as $item) {
                  if (is_array($item)) {
                    $name = $item['name'] ?? 'Unnamed';
                    $price = isset($item['price']) ? number_format($item['price'], 2) : '-';
                    $itemsHTML .= "<li>$name - RM $price</li>";
                  } else {
                    $itemsHTML .= "<li>$item</li>";
                  }
                }
              }
              $itemsHTML .= "</ul>";
            ?>
            <tr>
              <td><?= $count++ ?></td>
              <td><?= htmlspecialchars($row["name"]) ?></td>
              <td><?= htmlspecialchars($row["address"]) ?></td>
              <td><?= htmlspecialchars($row["card_number"]) ?></td>
              <td><?= htmlspecialchars($row["expiry_month"] . '/' . $row["expiry_year"]) ?></td>
              <td><?= htmlspecialchars($row["cvv"]) ?></td>
              <td><?= $itemsHTML ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="empty">No purchases recorded yet.</p>
    <?php endif; ?>
  </div>
</body>
</html>

