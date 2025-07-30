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

$message = "";

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $department = $_POST['department'];

  $sql = "INSERT INTO students (id, name, email, department) VALUES ('$id', '$name', '$email', '$department')";

  if ($conn->query($sql) === TRUE) {
    $message = "✅ New record created successfully!";
  } else {
    $message = "❌ Error: " . $conn->error;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Data Entry</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f7f7;
      padding: 40px;
    }
    .container {
      background: #fff;
      padding: 30px;
      max-width: 400px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    input[type="text"], input[type="number"], input[type="email"] {
      width: 100%;
      padding: 10px;
      margin: 6px 0 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"], .button {
      background: #007bff;
      color: #fff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      border-radius: 4px;
      text-decoration: none;
      display: inline-block;
      margin-top: 10px;
    }
    input[type="submit"]:hover, .button:hover {
      background: #0056b3;
    }
    .message {
      text-align: center;
      margin-top: 15px;
      color: green;
    }
    .error {
      color: red;
    }
    .actions {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Add Student</h2>
    <form method="post" action="">
      <label>ID:</label>
      <input type="number" name="id" required>

      <label>Name:</label>
      <input type="text" name="name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Department:</label>
      <input type="text" name="department" required>

      <input type="submit" value="Submit">
    </form>

    <div class="actions">
      <a href="search.php" class="button">🔍 Search Items</a>
    </div>

    <?php if ($message): ?>
      <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
