<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once 'config.php';

$client = new Google_Client();
$client->setClientId('734858177442-k3np8voq81tt93pggsvbivi84u3tpd32.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/github_clone/google-callback.php');
$client->addScope("email");
$client->addScope("profile");

$login_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in · GitHub Clone</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0d1117; /* GitHub dark background */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            color: #c9d1d9;
        }
        .login-container {
            width: 320px;
            padding: 20px;
        }
        .login-box {
            background: #161b22;
            padding: 24px;
            border: 1px solid #30363d;
            border-radius: 6px;
            text-align: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }
        .login-box h1 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #f0f6fc;
        }
        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #db4437;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        .google-btn img {
            margin-right: 8px;
        }
        .google-btn:hover {
            background: #c33d2f;
        }
        .footer-text {
            margin-top: 16px;
            font-size: 12px;
            color: #8b949e;
            text-align: center;
        }
        .footer-text a {
            color: #58a6ff;
            text-decoration: none;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Sign in to GitHub Clone</h1>
            <a href="<?php echo htmlspecialchars($login_url); ?>" class="google-btn">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" width="20">
                Continue with Google
            </a>
        </div>
        <p class="footer-text">
            New to GitHub Clone? <a href="signup.php">Create an account</a>.
        </p>
    </div>
</body>
</html>
