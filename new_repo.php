<?php
session_start();

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "github_clone";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("DB connection failed: " . $conn->connect_error);
    }

    $name = trim($_POST['name']);
    $visibility = $_POST['visibility'];
    $user_id = $_SESSION['user_id'];

    if (!empty($name)) {
        $sql = "INSERT INTO repositories (user_id, name, visibility) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $name, $visibility);
        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Repository name cannot be empty.";
    }

    $conn->close();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Create a New Repository</title>
  <link rel="stylesheet" href="dashboard.css" />
  <style>
    .form-container {
      max-width: 500px;
      margin: 50px auto;
      background: var(--elev);
      padding: 20px;
      border-radius: 8px;
      border: 1px solid var(--border);
    }
    .form-container h2 {
      margin-top: 0;
      color: #fff;
    }
    .form-container label {
      display: block;
      margin: 12px 0 6px;
      font-weight: 600;
    }
    .form-container input, .form-container select {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid var(--border);
      background: #0d1117;
      color: var(--fg);
    }
    .form-container button {
      margin-top: 20px;
    }
    .error { color: #ff7b72; margin-top: 10px; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>New Repository</h2>
    <?php if (isset($error)): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="">
      <label for="name">Repository name</label>
      <input type="text" id="name" name="name" required />

      <label for="visibility">Visibility</label>
      <select id="visibility" name="visibility">
        <option value="public">Public</option>
        <option value="private">Private</option>
      </select>

      <button type="submit" class="btn btn--primary">Create Repository</button>
    </form>
  </div>
</body>
</html>