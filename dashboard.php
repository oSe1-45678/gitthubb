<?php
session_start();

// Redirect if user not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "github_clone";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("DB connection failed: " . $conn->connect_error);

$user_id = $_SESSION['user_id'];

// Fetch user profile
$sql = "SELECT username, avatar_url, bio, followers, following FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();
$stmt->close();

// Provide fallbacks if fields are NULL (important for Google signups)
$user['avatar_url'] = $user['avatar_url'] ?? "https://avatars.githubusercontent.com/u/1?v=4";
$user['bio']        = $user['bio'] ?? "No bio available.";
$user['followers']  = $user['followers'] ?? 0;
$user['following']  = $user['following'] ?? 0;

// Fetch repositories for logged-in user
$sql = "SELECT id, name, visibility, updated_at FROM repositories WHERE user_id = ? ORDER BY updated_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$repos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css" />
</head>
<body>
  <!-- Top Bar -->
  <header class="topbar">
    <div class="topbar__left">
      <a href="#" class="brand">Octo</a>
      <form class="search">
        <input type="search" placeholder="Search or jump to…" />
      </form>
    </div>
    <div class="topbar__right">
      <a href="#" class="icon">+</a>
      <a href="#" class="icon">🔔</a>
      <div class="profile">
        <img src="<?php echo htmlspecialchars($user['avatar_url']); ?>" alt="User avatar" />
      </div>
    </div>
  </header>

  <!-- Layout -->
  <div class="layout">
    
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="profile-card">
        <img src="<?php echo htmlspecialchars($user['avatar_url']); ?>" alt="Avatar">
        <h2><?php echo htmlspecialchars($user['username']); ?></h2>
        <p class="bio"><?php echo htmlspecialchars($user['bio']); ?></p>

        <div class="stats">
          <span><strong><?php echo $user['followers']; ?></strong> followers</span>
          ·
          <span><strong><?php echo $user['following']; ?></strong> following</span>
        </div>
        <a href="edit_profile.php" class="btn btn--small">Edit profile</a>
      </div>

      <ul class="sidebar-links">
        <li><a href="#" class="active">Overview</a></li>
        <li><a href="#">Repositories</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Stars</a></li>
        <li><a href="#">Followers</a></li>
        <li><a href="#">Following</a></li>
      </ul>
    </aside>

    <!-- Main -->
    <main class="main">
      <div class="repos-header">
        <h2>Repositories</h2>
        <a href="new_repo.php" class="btn btn--small">New</a>
      </div>

      <div class="repo-filters">
        <ul class="repo-list">
        <?php if (count($repos) > 0): ?>
          <?php foreach ($repos as $repo): ?>
            <li>
              <a href="#"><?php echo htmlspecialchars($repo['name']); ?></a>
              <span class="tag"><?php echo ucfirst($repo['visibility']); ?></span>
              <time>Updated <?php echo date("M d, Y", strtotime($repo['updated_at'])); ?></time>

              <!-- Actions -->
              <div class="repo-actions">
                <a href="edit_repo.php?id=<?php echo $repo['id']; ?>" class="btn btn--small">Edit</a>
                <a href="delete_repo.php?id=<?php echo $repo['id']; ?>" 
                   class="btn btn--small btn--danger"
                   onclick="return confirm('Are you sure you want to delete this repository?');">
                   Delete
                </a>
              </div>
            </li>
          <?php endforeach; ?>
        <?php else: ?>
          <li>No repositories yet. <a href="new_repo.php">Create one?</a></li>
        <?php endif; ?>
        </ul>
      </div>
    </main>

    <!-- Right Panel -->
    <aside class="rightbar">
      <h3>Recent activity</h3>
      <p>(Activity feed can go here...)</p>
    </aside>
  </div>
</body>
</html>

