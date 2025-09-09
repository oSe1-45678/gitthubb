<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once 'config.php'; // make sure this contains your $conn DB connection

$client = new Google_Client();
$client->setClientId('734858177442-k3np8voq81tt93pggsvbivi84u3tpd32.apps.googleusercontent.com'); // ✅ No http://
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/github_clone/google-callback.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
            throw new Exception('Error fetching access token: ' . $token['error_description']);
        }

        $client->setAccessToken($token);
        $oauth2 = new Google\Service\Oauth2($client);   
        $google_account_info = $oauth2->userinfo->get();

        $google_id = $google_account_info->id;
        $email = $google_account_info->email;
        $name = $google_account_info->name;

        // check if user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE google_id = ? OR email = ?");
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }
        $stmt->bind_param("ss", $google_id, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, email, google_id) VALUES (?, ?, ?)");
            if (!$stmt) {
                throw new Exception('Prepare failed: ' . $conn->error);
            }
            $stmt->bind_param("sss", $name, $email, $google_id);
            $stmt->execute();
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $name;
        }

        // Redirect safely (no echo before header)
        header("Location: dashboard.php");
        exit;

    } catch (Exception $e) {
        echo "<h2>Callback Error</h2>";
        echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
        exit;
    }
} else {
    echo "<h2 class='text-danger'>Google login failed!</h2>";
}
