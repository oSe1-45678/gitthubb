<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid credentials";
        }
    } else {
        $error = "User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign in to Gitthubb</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
    <style>
         body {
      background-color: #0d1117;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
    }
       
        .login-box {
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

        .google-btn {
            background: #fff;
            color: #000;
            border: 1px solid #30363d;
            font-weight: 500;
        }

        .google-btn img {
            margin-right: 8px;
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

    <div class="login-box">
        <h3 class="mb-4 text-white text-center">Sign in to Gitthubb</h3>

        <?php if (!empty($error))
            echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST">
            <div class="mb-3 text-start">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-success w-100 mb-3" type="submit">Sign in</button>
        </form>

        <!-- Google Login -->
        <a href="google-login.php" class="btn google-btn w-100 mb-3">
            <img src="https://developers.google.com/identity/images/g-logo.png" width="18">
            Sign in with Google
        </a>

        <p class="mt-3 text-center text-white">
            New to Gitthubb? <a href="signup.php">Create an account</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>