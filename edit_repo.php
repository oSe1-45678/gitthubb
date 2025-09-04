<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "github_clone";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("DB connection failed: " . $conn->connect_error);

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php");
    exit();
}

// Fetch repo details
$sql = "SELECT * FROM repositories WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$repo = $result->fetch_assoc();
$stmt->close();

if (!$repo) {
    header("Location: dashboard.php");
    exit();
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $visibility = $_POST['visibility'];

    if (!empty($name)) {
        $sql = "UPDATE repositories SET name=?, visibility=?, updated_at=NOW() WHERE id=? AND user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $name, $visibility, $id, $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Repository name cannot be empty.";
    }
}
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Repository</title>
  <link rel="stylesheet" href="dashboard.css">
  <style>
    .form-container { max-width: 500px; margin: 50px auto; background: var(--elev); padding: 20px; border-radius: 8px; border: 1px solid var(--border); }
    .form-container h2 { color: #fff; }
    .form-container label { display: block; margin: 12px 0 6px; }
    .form-container input, .form-container select { width: 100%; padding: 10px; background: #0d1117; border: 1px solid var(--border); border-radius: 6px; color: var(--fg); }
    .error { color: #ff7b72; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Repository</h2>
    <?php if (isset($error)): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>

    <form method="post">
      <label for="name">Repository name</label>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($repo['name']); ?>" required>

      <label for="visibility">Visibility</label>
      <select id="visibility" name="visibility">
        <option value="public" <?php echo $repo['visibility']=='public'?'selected':''; ?>>Public</option>
        <option value="private" <?php echo $repo['visibility']=='private'?'selected':''; ?>>Private</option>
      </select>

      <button type="submit" class="btn btn--primary">Save Changes</button>
    </form>
  </div>
</body>
</html>