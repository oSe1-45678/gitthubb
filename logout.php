<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Logout</title>
	<link href="bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="height:100vh;">
<div class="login-box p-4 rounded text-center">
<?php
session_start();
session_destroy();
echo '<h2 class="text-success">You have been logged out.</h2>';
echo '<a href="login.php" class="btn btn-success mt-3">Sign in again</a>';
?>
</div>
</body>
</html>
