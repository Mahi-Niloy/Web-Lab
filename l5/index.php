<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $id = $_POST['id'] ?? '';

    if ($id) {
        updateUser($id, $name, $email);
    } else {
        createUser($name, $email);
    }
    header("Location: index.php");
    exit;
}

if (isset($_GET['delete'])) {
    deleteUser(intval($_GET['delete']));
    header("Location: index.php");
    exit;
}

$editUser = null;
if (isset($_GET['edit'])) {
    $editUser = getUser(intval($_GET['edit']));
}

$users = getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PHP MySQL CRUD</title>
  <link href="style.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container py-4">

  <h1 class="mb-4">User Management CRUD</h1>

  <!-- Form -->
  <div class="card mb-4">
    <div class="card-header"><?= $editUser ? "Edit User" : "Add New User" ?></div>
    <div class="card-body">
      <form method="POST" action="index.php" class="crud-form">
        <input type="hidden" name="id" value="<?= $editUser['id'] ?? '' ?>" />
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            required
            value="<?= htmlspecialchars($editUser['name'] ?? '') ?>"
          />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            class="form-control"
            required
            value="<?= htmlspecialchars($editUser['email'] ?? '') ?>"
          />
        </div>
        <button type="submit" class="btn btn-primary"><?= $editUser ? "Update User" : "Add User" ?></button>
        <?php if ($editUser): ?>
        <a href="index.php" class="btn btn-secondary ms-2">Cancel</a>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- Users Table -->
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th><th>Name</th><th>Email</th><th width="150px">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($users) === 0): ?>
      <tr><td colspan="4" class="text-center">No users found.</td></tr>
      <?php else: ?>
      <?php foreach ($users as $user): ?>
      <tr>
        <td><?= $user['id'] ?></td>
        <td><?= htmlspecialchars($user['name']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td>
          <a href="index.php?edit=<?= $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="index.php?delete=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this user?')">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

</div>

</body>
</html>
