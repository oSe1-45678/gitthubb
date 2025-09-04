<?php
// Database connection
$servername = "localhost";
$username = "root";   // your DB username
$passwordDB = "";       // your DB password
$dbname = "github_clone"; // replace with your DB name

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process form only if submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // 1. Check if email already exists
  $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
  $checkStmt->bind_param("s", $email);
  $checkStmt->execute();
  $checkStmt->store_result();

  if ($checkStmt->num_rows > 0) {
    echo "❌ Email already registered. Please log in.";
  } else {
    // 2. Insert new user (with hashed password)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $insertStmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $insertStmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($insertStmt->execute()) {
      echo "✅ Signup successful!";
    } else {
      echo "Error: " . $insertStmt->error;
    }

    $insertStmt->close();
  }

  $checkStmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Create an account - Gitthubb</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


  <link rel="stylesheet" href="style.css">
</head>


<body style="background-color:#0d1117; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Helvetica,Arial,sans-serif;">
  <div class="d-flex align-items-center justify-content-center" style="height:100vh;">
    <div class="auth-form signup-box" style="background-color:#161b22; border:1px solid #30363d; width:360px; padding:24px; border-radius:6px;">
      <h2 class="mb-4 text-white text-center" style="font-weight:300;">Create your account</h2>
      <form method="POST">
        <div class="form-group mb-3 text-start">
          <label for="username" style="color:#c9d1d9; font-weight:500;">Username</label>
          <input type="text" name="username" id="username" class="form-control" required style="background-color:#0d1117; border:1px solid #30363d; color:#c9d1d9;">
        </div>
        <div class="form-group mb-3 text-start">
          <label for="email" style="color:#c9d1d9; font-weight:500;">Email address</label>
          <input type="email" name="email" id="email" class="form-control" required style="background-color:#0d1117; border:1px solid #30363d; color:#c9d1d9;">
        </div>
        <div class="form-group mb-3 text-start">
          <label for="password" style="color:#c9d1d9; font-weight:500;">Password</label>
          <input type="password" name="password" id="password" class="form-control" required style="background-color:#0d1117; border:1px solid #30363d; color:#c9d1d9;">
        </div>
        <button class="btn btn-success w-100 mb-3" type="submit" style="background-color:#238636; border:none; font-weight:600;">Sign up</button>
      </form>
      <p class="mt-3 text-center text-white">
        Already have an account? <a href="login.php" style="color:#58a6ff;">Sign in</a>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>