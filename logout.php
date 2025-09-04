<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Logout</title>
<<<<<<< HEAD
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
=======

	<link rel="stylesheet" href="/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

>>>>>>> 909eb3390a07261092d8ffb7a60c4e2f4945549b
</head>
<body class="d-flex align-items-center justify-content-center" style="height:100vh;">
<div class="login-box p-4 rounded text-center">
<?php
session_start();
session_destroy();
header('Location: index.html');
exit();
?>
