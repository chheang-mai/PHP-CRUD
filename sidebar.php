<!-- Sidebar -->
 <style>
     .sidebar {
            width: 250px;
            height: 100vh;
            background: #111;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            transition: 0.3s;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            margin: 5px;
            font-size: 16px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: red;
            border-radius: 5px;
        }
        .sidebar .logo {
            font-size: 24px;
            text-align: center;
            color: red;
            font-weight: bold;
            padding-bottom: 10px;
            border-bottom: 1px solid red;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }
            .sidebar a {
                text-align: center;
                font-size: 12px;
                padding: 8px;
            }
            .sidebar .logo {
                font-size: 18px;
            }
            .content {
                margin-left: 60px;
            }
        }
 </style>
<div class="sidebar">
        <div class="logo">NETFLIX ADMIN</div>
        <a href="dashboard.php">📊 Dashboard</a>
          <a href="sign-up.php">➕ Add Post</a>
        <a href="list-users.php">👤Users</a>
        <a href="settings.php">⚙️ Settings</a>   
        <a href="logout.php">🚪 Logout</a>
    </div>