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
  <link href="bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #0d1117;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
    }
    .signup-box {
      background-color: #161b22;
      border: 1px solid #30363d;
      width: 360px;
      padding: 24px;
      border-radius: 6px;
    }
    .form-control {
      background-color: #0d1117;
      border: 1px solid #30363d;
      color: #c9d1d9;
    }
    .form-control:focus {
      border-color: #58a6ff;
      box-shadow: none;
    }
    label {
      font-weight: 500;
      color: #c9d1d9;
    }
    .btn-success {
      background-color: #238636;
      border: none;
      font-weight: 600;
    }
    .btn-success:hover {
      background-color: #2ea043;
    }
    a {
      color: #58a6ff;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
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

</body>
</html>