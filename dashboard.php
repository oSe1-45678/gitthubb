<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/gitthubb/dashboard.php");
    exit;
}
include "config.php";
?>

<!DOCTYPE html>http://localhost/gitthubb/dashboard.php
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gitthubb Dashboard</title>
    <!-- Bootstrap -->
    <link href="bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css"
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg px-3">
        <a class="navbar-brand text-white" href="#">
            <svg height="32" viewBox="0 0 16 16" width="32" aria-hidden="true" fill="white">
                <path d="M8 0C3.58 0 0 3.58..."></path>
            </svg>
        </a>

        <!-- Search bar -->
        <form class="d-flex mx-3 flex-grow-1" method="GET" action="dashboard.php">
            <input class="form-control search-box" type="search" name="search" placeholder="Search or jump to...">
        </form>

        <!-- Top Menus -->
        <ul class="navbar-nav me-3">
            <li class="nav-item"><a class="nav-link">Pull requests</a></li>
            <li class="nav-item"><a class="nav-link">Issues</a></li>
            <li class="nav-item"><a class="nav-link">Marketplace</a></li>
            <li class="nav-item"><a class="nav-link">Explore</a></li>
        </ul>

        <!-- Profile dropdown -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/img/avatar.png" alt="profile" width="32" height="32" class="rounded-circle me-2">
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
                <li><a class="dropdown-item">Your profile</a></li>
                <li><a class="dropdown-item">Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
        </div>
    </nav>

    <!-- Layout -->
    <div class="container mt-4">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <div class="text-center mb-3">
                    <img src="assets/img/avatar.png" width="120" class="rounded-circle border">
                    <h5 class="mt-2 text-white"><?php echo $_SESSION['username']; ?></h5>
                </div>
                <ul class="list-group">
                    <a class="list-group-item active">Overview</a>
                    <a class="list-group-item">Repositories</a>
                    <a class="list-group-item">Projects</a>
                    <a class="list-group-item">Packages</a>
                    <a class="list-group-item">Stars</a>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-white">Repositories</h3>
                    <a href="#" class="btn btn-success">New</a>
                </div>

                <!-- Repo List -->
                <div>
                    <?php
                    // Create new repo
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['repo_name'])) {
                        $repo_name = trim($_POST['repo_name']);
                        $repo_desc = trim($_POST['repo_desc']);
                        $user_id = $_SESSION['user_id'];

                        $sql = "INSERT INTO repositories (user_id, name, description) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iss", $user_id, $repo_name, $repo_desc);
                        $stmt->execute();
                    }

                    // Search
                    $search = $_GET['search'] ?? "";
                    if ($search) {
                        $sql = "SELECT * FROM repositories WHERE user_id = ? AND name LIKE ?";
                        $stmt = $conn->prepare($sql);
                        $like = "%$search%";
                        $stmt->bind_param("is", $_SESSION['user_id'], $like);
                    } else {
                        $sql = "SELECT * FROM repositories WHERE user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $_SESSION['user_id']);
                    }
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($repo = $result->fetch_assoc()) {
                        echo '<div class="repo-item">';
                        echo '<h5><a href="#" class="repo-link">' . htmlspecialchars($repo['name']) . '</a></h5>';
                        if (!empty($repo['description'])) {
                            echo '<p>' . htmlspecialchars($repo['description']) . '</p>';
                        }
                        echo '<small>Updated ' . date("M d, Y", strtotime($repo['created_at'])) . '</small>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>