<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
require_once 'config/config.php';
require_once 'includes/functions.php';

// session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$validatePage = array(
    'home' => 'home',
    'about' => 'about',
    'artisandetail' => 'artisan-details',
    'artisans' => 'artisans',
    'contact' => 'contact',
    'news'=>'news',
    'templedetail'=>'temple-details',
    'temples'=>'temples',
    'profile'=>'profile',
    'newdetail'=>'post-details'
  );

  $titlePage = array(
    'home' => 'Cambodia Heritage - Explore Temples and Artisans',
    'about' => 'About Us - Cambodia Heritage',
    'artisandetail' => 'Artisan Details - Cambodia Heritage',
    'artisans' => 'Local Artisans - Cambodia Heritage',
    'contact' => 'Contact Us - Cambodia Heritage',
    'news'=>'News - Cambodia Heritage',
    'templedetail'=>'Temple Details - Cambodia Heritage',
    'temples'=>'Temples - Cambodia Heritage',
    'profile'=>'User Profile - Cambodia Heritage',
    'newdetail'=>'New Details - Cambodia Heritage'
  );
  
// Initialize Database Connection
$db = new Database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Discover the rich cultural heritage and treasures of Cambodia" />
    <title>
       <?php
            $page=null;
            if($_GET['page'] && isset($validatePage[$_GET['page']]) && ctype_lower($_GET['page']) && !ctype_space($_GET['page'])){
              $page = $titlePage[$_GET['page']];
            }else{
                echo '404';
            }
       ?> 
    </title>
    <link rel="stylesheet" href="src/styles/main.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <a href="?page=home">
                   <h4><?php echo get_setting('site_name'); ?></h4>
                </a>
            </div>
            <nav class="navbar">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="?page=home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=temples" class="nav-link">Temples</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=artisans" class="nav-link">Local Artisans</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=news" class="nav-link">News</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=about" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=contact" class="nav-link">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['user_username'])): ?>
                        <li class="nav-item">
                            <a href="?page=profile" class="nav-link">Profile</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="admin/index?page=dashboard" class="nav-link">Manage Page</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="admin/logout.php" class="nav-link">Logout</a>
                        </li> -->
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="admin/login.php" class="nav-link">Login</a>
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

    <main>
    <?php
        if($_GET['page'] && isset($validatePage[$_GET['page']]) && ctype_lower($_GET['page']) && !ctype_space($_GET['page'])){
            $incPage = 'src/pages/'.$validatePage[$_GET['page']] . '.php';
            include $incPage;
        }else{
            if(basename(__FILE__) == "index.php"){
                header("Location: ?page=home");
                exit;
            }else{
                echo '404';
            }
        }
        ?>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <!-- <img src="assets/images/logo.png" alt="Cambodia Heritage Logo" /> -->
                    <h3>Cambodia Heritage</h3>
                    <p>Exploring and preserving Cambodia's rich cultural heritage.</p>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="?page=home">Home</a></li>
                        <li><a href="?page=temples">Temples</a></li>
                        <li><a href="?page=artisans">Local Artisans</a></li>
                        <li><a href="?page=about">About</a></li>
                        <li><a href="?page=contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Heritage Street, Phnom Penh, Cambodia</p>
                    <p><i class="fas fa-phone"></i> +855 23 456 789</p>
                    <p><i class="fas fa-envelope"></i> info@cambodiaheritage.com</p>
                </div>
                <div class="footer-social">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Cambodia Heritage. All Rights Reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="src/js/main.js"></script>
</body>
</html>