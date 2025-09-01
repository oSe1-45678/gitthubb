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
    <link rel="stylesheet" href="style.css">
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

</body>

</html>