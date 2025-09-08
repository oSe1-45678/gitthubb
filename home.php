
        <!-- Main -->
        <main class="main">
            <div class="repos-header">
                <h2>Repositories</h2>
                <a href="new_repo.php" class="btn btn--small">New</a>
            </div>
            <div class="repo-filters">
                <ul class="repo-list">
                    <li>
                        <a href="dashboard.php" class="btn btn--primary">Open Dashboard</a>
                    </li>
                </ul>
            </div>
        </main>
        .main {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(180deg, #0d1117, #21262d);
        }
        .main h1 {
            font-size: 48px;
            margin: 0;
        }
        .main p {
            font-size: 20px;
            color: #8b949e;
            max-width: 600px;
            margin: 20px auto;
        }
        .cta-button {
            background-color: #238636;
            color: #fff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
        }
        .cta-button:hover {
            background-color: #2ea043;
        }
        .globe-placeholder {
            width: 300px;
            height: 300px;
            background: #30363d;
            border-radius: 50%;
            margin: 40px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8b949e;
            font-size: 18px;
        }
        .footer {
            background-color: #161b22;
            padding: 40px 20px;
            text-align: center;
            font-size: 14px;
            color: #8b949e;
        }
        .footer a {
            color: #58a6ff;
            text-decoration: none;
            margin: 0 8px;
        }
        @media (max-width: 768px) {
            .main h1 {
                font-size: 32px;
            }
            .main p {
                font-size: 16px;
            }
            .navbar a {
                margin: 0 8px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo">GitHub</div>
        <div>
            <a href="#">Explore</a>
            <a href="#">Pricing</a>
            <a href="#">Sign In</a>
            <a href="#" class="cta-button">Sign Up</a>
        </div>
    </header>
    <section class="main">
        <h1>Where the world builds software</h1>
        <p>Millions of developers and companies build, ship, and maintain their software on GitHub—the largest and most advanced development platform in the world.</p>
        <a href="#" class="cta-button">Start a free trial</a>
        <div class="globe-placeholder">Dynamic Globe Placeholder</div>
    </section>
    <footer class="footer">
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
        <a href="#">Docs</a>
        <a href="#">Contact GitHub</a>
    </footer>
</body>
</html>