<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab-6";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$search = "";
$results = [];

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM students 
          WHERE id = '$search'
          OR name LIKE '%$search%'
          OR email LIKE '%$search%'
          OR department LIKE '%$search%'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $results = $result->fetch_all(MYSQLI_ASSOC);
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Search Students</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f7f7;
      padding: 40px;
    }
    .container {
      background: #fff;
      padding: 30px;
      max-width: 600px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    input[type="text"] {
      width: calc(100% - 100px);
      padding: 10px;
      margin: 6px 0 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      background: #007bff;
      color: #fff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      border-radius: 4px;
    }
    input[type="submit"]:hover {
      background: #0056b3;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      text-align: left;
      padding: 8px;
    }
    tr:nth-child(even){
      background-color: #f2f2f2;
    }
    .actions {
      text-align: center;
      margin-top: 20px;
    }
    .button {
      background: #007bff;
      color: #fff;
      padding: 8px 20px;
      border: none;
      border-radius: 4px;
      text-decoration: none;
    }
    .button:hover {
      background: #0056b3;
    }
    .no-results {
      text-align: center;
      color: #555;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Search Students</h2>
    <form method="get" action="">
      <input type="text" name="search" placeholder="Search by ID, Name, Email, Department" value="<?php echo htmlspecialchars($search); ?>" required>
      <input type="submit" value="Search">
    </form>

    <?php if (isset($_GET['search'])): ?>
      <?php if (!empty($results)): ?>
        <table>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
          </tr>
          <?php foreach ($results as $row): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['id']); ?></td>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['department']); ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <p class="no-results">❌ No results found for "<strong><?php echo htmlspecialchars($search); ?></strong>".</p>
      <?php endif; ?>
    <?php endif; ?>

    <div class="actions">
      <a href="index.php" class="button">⬅️ Back to Insert</a>
    </div>
  </div>
</body>
</html>
