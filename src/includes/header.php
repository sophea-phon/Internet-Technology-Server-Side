<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../config/database.php';

// Initialize Database Connection
$db = new Database();
?>

<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="../../index.php">
                 <h4>Cambodia Heritage</h4>
            </a>
        </div>
        <nav class="navbar">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="../../index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="../../src/pages/temples.php" class="nav-link">Temples</a>
                </li>
                <li class="nav-item">
                    <a href="../../src/pages/artisans.php" class="nav-link">Local Artisans</a>
                </li>
                <li class="nav-item">
                    <a href="../../src/pages/news.php" class="nav-link">News</a>
                </li>
                <li class="nav-item">
                    <a href="../../src/pages/about.php" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="../../src/pages/contact.php" class="nav-link">Contact</a>
                </li>
                <?php if (isset($_SESSION['user_username'])): ?>
                   
                    <li class="nav-item">
                        <a href="../../admin/logout.php" class="nav-link">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="../../admin/login.php" class="nav-link">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </div>
</header>