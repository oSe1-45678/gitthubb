

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GitHub Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #0d1117;
            color: #c9d1d9;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .navbar {
            background-color: #161b22;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #30363d;
        }
        .navbar a {
            color: #c9d1d9;
            text-decoration: none;
            margin: 0 12px;
            font-size: 14px;
        }
        .navbar a:hover {
            color: #58a6ff;
        }
        .sidebar {
            width: 250px;
            background-color: #0d1117;
            padding: 20px;
            border-right: 1px solid #30363d;
        }
        .sidebar h3 {
            font-size: 16px;
            margin: 20px 0 10px;
            color: #8b949e;
        }
        .sidebar a {
            color: #c9d1d9;
            text-decoration: none;
            display: block;
            margin: 12px 0;
            font-size: 18px;
        }
        .sidebar a:hover {
            color: #58a6ff;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            max-width: 700px;
        }
        .feed-item {
            background-color: #161b22;
            padding: 16px;
            margin-bottom: 16px;
            border-radius: 6px;
            border: 1px solid #30363d;
        }
        .feed-item h4 {
            margin: 0;
            font-size: 16px;
            color: #c9d1d9;
        }
        .feed-item p {
            margin: 8px 0 0;
            color: #8b949e;
            font-size: 14px;
        }
        .feed-item a {
            color: #58a6ff;
            text-decoration: none;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #30363d;
            }
            .main-content {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div>
            <a href="#" id="github-link" style="display:flex;align-items:center;">
                <span style="display:flex;align-items:center;margin-right:6px;">
                    <svg width="32" height="24" viewBox="0 0 32 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="6" width="28" height="14" rx="3" fill="#fff" stroke="#30363d" stroke-width="2"/>
                        <rect x="8" y="20" width="16" height="2" rx="1" fill="#30363d"/>
                        <text x="16" y="16" text-anchor="middle" fill="#30363d" font-size="10" font-family="Arial" font-weight="bold">GTH</text>
                    </svg>
                </span>
                <span style="font-size:20px;">GitHub</span>
            </a>
        </div>
        <div>
            <a href="dashboard.php">Repositories</a>
            <a href="#" id="issues-link">Issues</a>
            <a href="#" id="pulls-link">Pull Requests</a>
            <a href="#" id="profile-link">Profile</a>
        </div>
    </header>
    <div class="container" style="position:relative;">
        <aside class="sidebar" id="main-sidebar" style="display:none; position: absolute; left: 0; top: 0; height: 100%; z-index: 10;">
            <h3>Menu</h3>
            <a href="#">Home</a>
            <a href="#">Issues</a>
            <a href="#">Pull requests</a>
            <a href="#">Projects</a>
            <a href="#">Discussion</a>
            <a href="#">Codespaces</a>
            <a href="#">Copilot</a>
            <a href="#">Explore marketplace</a>
            <input type="text" placeholder="Search..." style="width:90%;margin:12px 0;padding:6px;border-radius:4px;border:1px solid #30363d;background:#161b22;color:#c9d1d9;">
        </aside>
        <main class="main-content">
            <h2>Dashboard</h2>
            <div class="feed-item">
                <h4><a href="#">user/repo</a> pushed to main</h4>
                <p>2 commits • 3 hours ago</p>
            </div>
            <div class="feed-item">
                <h4><a href="#">user/issue</a> opened issue #123</h4>
                <p>"Fix login bug" • 5 hours ago</p>
            </div>
            <div class="feed-item">
                <h4><a href="#">user/pr</a> submitted pull request #456</h4>
                <p>"Add new feature" • Yesterday</p>
            </div>
        </main>
        <aside class="sidebar" id="profile-sidebar" style="display:none; position: absolute; right: 0; top: 0; height: 100%; z-index: 10;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <img src="https://avatars.githubusercontent.com/u/1?v=4" alt="Avatar" style="width:48px;height:48px;border-radius:50%;border:1px solid #30363d;">
                <span style="font-size:18px;font-weight:bold;color:#c9d1d9;">User</span>
            </div>
            <h3>Profile Menu</h3>
            <a href="#">Profile</a>
            <a href="#">Repositories</a>
            <a href="#">Gist</a>
            <a href="#">Organizations</a>
            <a href="#">Enterprises</a>
            <a href="#">Sponsors</a>
            <a href="#">Settings</a>
            <a href="logout.php" style="color:#f85149;font-weight:bold;margin-top:18px;">Sign Out</a>
        </aside>
    </div>
    <script>
        // Sidebar toggle logic
        document.getElementById('github-link').onclick = function(e) {
            e.preventDefault();
            var mainSidebar = document.getElementById('main-sidebar');
            var profileSidebar = document.getElementById('profile-sidebar');
            if (mainSidebar.style.display === 'block') {
                mainSidebar.style.display = 'none';
            } else {
                mainSidebar.style.display = 'block';
                profileSidebar.style.display = 'none';
            }
        };
        document.getElementById('profile-link').onclick = function(e) {
            e.preventDefault();
            var profileSidebar = document.getElementById('profile-sidebar');
            var mainSidebar = document.getElementById('main-sidebar');
            if (profileSidebar.style.display === 'block') {
                profileSidebar.style.display = 'none';
            } else {
                profileSidebar.style.display = 'block';
                mainSidebar.style.display = 'none';
            }
        };
    </script>
</body>
</html>