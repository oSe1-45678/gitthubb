
<?php
require_once __DIR__ . '/google-api-php-client-v2.18.3-PHP8.3/vendor/autoload.php';
session_start();
$clientID = getenv('GOOGLE_CLIENT_ID') ?: 'http://734858177442-k3np8voq81tt93pggsvbivi84u3tpd32.apps.googleusercontent.com';
$clientSecret = getenv('GOOGLE_CLIENT_SECRET') ?: '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';
$redirectUri = getenv('GOOGLE_REDIRECT_URI') ?: 'http://localhost/github_clone/google-callback.php';
try {
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");
    $login_url = $client->createAuthUrl();
    header("Location: $login_url");
    exit;
} catch (Exception $e) {
    // Output error page
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Google Login Error</title>';
     echo '<link rel="stylesheet" href="style.css">';
    echo '</head><body class="d-flex align-items-center justify-content-center" style="height:100vh;">';
    echo '<div class="login-box p-4 rounded text-center">';
    echo "<h2>Google Client Error</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    echo "<h3>Debug Info</h3>";
    echo "<ul>";
    echo "<li>Client ID: " . htmlspecialchars($clientID) . "</li>";
    echo "<li>Client Secret: " . htmlspecialchars($clientSecret) . "</li>";
    echo "<li>Redirect URI: " . htmlspecialchars($redirectUri) . "</li>";
    echo "<li>Autoload Exists: " . (file_exists(__DIR__ . '/google-api-php-client-v2.18.3-PHP8.3/vendor/autoload.php') ? 'Yes' : 'No') . "</li>";
    echo "</ul>";
    echo '</div></body></html>';
    exit;
}
