<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $username, $email, $password);

  if ($stmt->execute()) {
    header("Location: login.php");
    exit;
  } else {
    $error = "Error creating account.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create an account - Gitthubb</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


    <link rel="stylesheet" href="style.css">
  </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="height:100vh;">

  <div class="signup-box">
    <h3 class="mb-4 text-white text-center">Create your account</h3>

    <form method="POST">
      <div class="mb-3 text-start">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3 text-start">
        <label>Email address</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3 text-start">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-success w-100 mb-3" type="submit">Sign up</button>
    </form>

    <p class="mt-3 text-center text-white">
      Already have an account? <a href="login.php">Sign in</a>
    </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>