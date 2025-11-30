<?php
error_reporting(0); // Menonaktifkan laporan kesalahan
ob_start(); // Memulai output buffering
session_start(); // Memulai sesi
include "config/koneksi.php"; // Menghubungkan ke database
include "config/fungsi_alert.php"; // Menghubungkan ke fungsi alert

// Detect if built assets exist
$distDir = __DIR__ . '/dist/assets/';
$hasBuiltAssets = is_dir($distDir);
$cssFile = null;
$jsFile = null;

if ($hasBuiltAssets) {
    // Find hashed CSS and JS files
    $cssFiles = glob($distDir . 'styles.*.css');
    $jsFiles = glob($distDir . 'main.*.js');
    $cssFile = !empty($cssFiles) ? 'dist/assets/' . basename($cssFiles[0]) : null;
    $jsFile = !empty($jsFiles) ? 'dist/assets/' . basename($jsFiles[0]) : null;
}

// Generate dynamic base URL for hosting compatibility
// Use SERVER_NAME when available (more reliable and server-configured), fallback to HTTP_HOST
// HTTP_HOST is sanitized to allow only valid hostname characters (alphanumeric, dots, hyphens, and colon for port)
// The output is also escaped with htmlspecialchars() in the HTML template for additional XSS protection
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = isset($_SERVER['SERVER_NAME']) && !empty($_SERVER['SERVER_NAME']) 
    ? $_SERVER['SERVER_NAME'] 
    : (isset($_SERVER['HTTP_HOST']) ? preg_replace('/[^a-zA-Z0-9\.\-:]/', '', $_SERVER['HTTP_HOST']) : 'localhost');
$base_url = $protocol . $host . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="<?php echo htmlspecialchars($base_url, ENT_QUOTES, 'UTF-8'); ?>">
    <title>DigNet 2.0 - Sistem Pakar Diagnosis Gangguan IndiHome</title>
    <link rel="icon" type="image/svg+xml" href="gambar/admin/favicon.svg">
    <link rel="alternate icon" href="gambar/admin/favicon.png">
    
    <!-- DNS Prefetch for Performance -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    <!-- Preconnect to External Resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts - Professional Typography (defer non-critical) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <?php if ($cssFile): ?>
        <!-- Production Build CSS (Optimized & Minified by Vite) -->
        <link rel="stylesheet" href="<?php echo $cssFile; ?>">
    <?php else: ?>
        <!-- Development Fallback: CDN Resources -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css" crossorigin="anonymous">
        <!-- Custom Styles -->
        <link rel="stylesheet" href="css/dignet-modern.css">
        <link rel="stylesheet" href="css/dignet-premium.css">
    <?php endif; ?>
    
    <!-- Critical CSS Inline (above-the-fold content) -->
    <style>
        /* Critical CSS for faster first paint */
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        .wrapper { min-height: 100vh; }
        .main-sidebar { transition: transform 0.3s ease-in-out, width 0.3s ease-in-out; }
        .content-wrapper { transition: margin-left 0.3s ease-in-out; }
        
        /* Font Awesome icon fix */
        .nav-icon, .fa-solid, .fa-regular, .fa-brands,
        i[class^="fa-"], i[class*=" fa-"] {
            display: inline-block !important;
            font-style: normal !important;
            font-variant: normal !important;
            text-rendering: auto !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }
        
        /* ==================== Smooth Sidebar Animations ==================== */
        /* Smooth sidebar slide-in/out animation */
        .main-sidebar {
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), 
                        width 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform, width;
        }
        
        /* Smooth sidebar menu items - general */
        .nav-sidebar .nav-item {
            transition: background-color 0.2s ease, transform 0.2s ease;
        }
        
        .nav-sidebar .nav-link {
            transition: background-color 0.25s ease, 
                        color 0.25s ease, 
                        transform 0.25s cubic-bezier(0.4, 0, 0.2, 1),
                        padding-left 0.25s ease,
                        box-shadow 0.25s ease;
        }
        
        /* Smooth hover effect on menu items */
        .nav-sidebar .nav-link:hover {
            transform: translateX(4px);
            background: rgba(255, 255, 255, 0.1);
        }
        
        /* Smooth icon transitions */
        .nav-sidebar .nav-icon {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                        color 0.25s ease,
                        font-size 0.25s ease;
        }
        
        .nav-sidebar .nav-link:hover .nav-icon {
            transform: scale(1.1);
        }
        
        /* Smooth dropdown/treeview animations */
        .nav-treeview {
            display: block;
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                        opacity 0.3s ease,
                        padding 0.3s ease;
            padding: 0;
        }
        
        .nav-item.menu-open > .nav-treeview,
        .nav-item.menu-is-opening > .nav-treeview {
            max-height: 500px; /* Large enough for expanded menus */
            opacity: 1;
            padding: 0.25rem 0;
        }
        
        /* Smooth treeview items */
        .nav-treeview .nav-item {
            transform: translateX(-10px);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        
        .nav-item.menu-open > .nav-treeview .nav-item,
        .nav-item.menu-is-opening > .nav-treeview .nav-item {
            transform: translateX(0);
            opacity: 1;
        }
        
        /* Staggered animation for treeview items */
        .nav-item.menu-open > .nav-treeview .nav-item:nth-child(1) { transition-delay: 0.05s; }
        .nav-item.menu-open > .nav-treeview .nav-item:nth-child(2) { transition-delay: 0.1s; }
        .nav-item.menu-open > .nav-treeview .nav-item:nth-child(3) { transition-delay: 0.15s; }
        .nav-item.menu-open > .nav-treeview .nav-item:nth-child(4) { transition-delay: 0.2s; }
        .nav-item.menu-open > .nav-treeview .nav-item:nth-child(5) { transition-delay: 0.25s; }
        
        /* Smooth dropdown arrow rotation */
        .nav-sidebar .nav-link > .right,
        .nav-sidebar .nav-link > p > .right,
        .nav-sidebar .nav-link .fa-angle-left,
        .nav-sidebar .nav-link .fa-angle-right,
        .nav-sidebar .nav-link .fa-chevron-down,
        .nav-sidebar .nav-link .fa-chevron-right {
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-item.menu-open > .nav-link > .right,
        .nav-item.menu-open > .nav-link > p > .right,
        .nav-item.menu-open > .nav-link .fa-angle-left,
        .nav-item.menu-open > .nav-link .fa-chevron-right {
            transform: rotate(-90deg);
        }
        
        .nav-item.menu-open > .nav-link .fa-chevron-down,
        .nav-item.menu-open > .nav-link .fa-angle-right {
            transform: rotate(90deg);
        }
        
        /* Smooth active state */
        .nav-sidebar .nav-link.active {
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }
        
        /* Smooth pushmenu (sidebar toggle) button */
        [data-widget="pushmenu"] {
            transition: transform 0.2s ease, background-color 0.2s ease;
        }
        
        [data-widget="pushmenu"]:hover {
            transform: scale(1.1);
        }
        
        /* Smooth mobile sidebar overlay */
        .sidebar-open::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0);
            z-index: 1037;
            transition: background 0.3s ease;
            pointer-events: none;
        }
        
        .sidebar-open.sidebar-animate::before {
            background: rgba(0, 0, 0, 0.4);
            pointer-events: auto;
        }
        
        /* Content area smooth transition when sidebar toggles */
        .content-wrapper,
        .main-header,
        .main-footer {
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Smooth brand logo animation */
        .brand-link {
            transition: padding 0.3s ease, background 0.3s ease;
        }
        
        .brand-link:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .brand-image, .brand-image-navbar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .brand-link:hover .brand-image,
        .navbar-brand:hover .brand-image-navbar {
            transform: rotate(5deg) scale(1.05);
        }
        
        /* Smooth scrollbar for sidebar */
        .sidebar {
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.2) transparent;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
            transition: background 0.3s ease;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.4);
        }
        
        /* Smooth nav header */
        .nav-header {
            transition: opacity 0.3s ease, padding 0.3s ease;
        }
        
        /* Reduce motion for accessibility */
        @media (prefers-reduced-motion: reduce) {
            .main-sidebar,
            .nav-sidebar .nav-item,
            .nav-sidebar .nav-link,
            .nav-sidebar .nav-icon,
            .nav-treeview,
            .nav-treeview .nav-item,
            .content-wrapper,
            .main-header,
            .main-footer,
            .brand-link,
            .brand-image,
            .brand-image-navbar,
            [data-widget="pushmenu"],
            .nav-sidebar .nav-link > .right,
            .nav-sidebar .nav-link > p > .right {
                transition: none !important;
                animation: none !important;
            }
        }
    </style>
</head>
<body id="dignet-indihome" class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar (AdminLTE v4 / Bootstrap 5) -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="./" class="nav-link">Home</a>
                </li>
            </ul>
            
            <!-- Center Brand Logo & Text (Modern SaaS Style) -->
            <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center flex-grow-1">
                <a href="./" class="navbar-brand d-flex align-items-center text-decoration-none">
                    <img src="gambar/admin/dignet-logo.svg" alt="DigNet Logo" class="brand-image-navbar" style="width: 2.5rem; height: 2.5rem; margin-right: 0.75rem; border-radius: 8px;" loading="lazy">
                    <span class="brand-text-navbar fw-bold" style="font-size: 1.25rem; color: #E21E2C; letter-spacing: 0.5px;">DigNet<span style="font-weight: 400; color: #666; margin-left: 0.25rem;">2.0</span></span>
                </a>
            </div>

            <!-- Right navbar links -->
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['username']) && isset($_SESSION['password'])) { ?>
                <!-- User Menu (Logged In) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="gambar/admin/admin.png" class="user-image rounded-circle" alt="User Image" style="width: 25px; height: 25px;" loading="lazy">
                        <span class="d-none d-md-inline"><?php echo htmlspecialchars(ucfirst($_SESSION['username'])); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li class="dropdown-header">
                            <img src="gambar/admin/admin.png" class="rounded-circle" alt="User Image" style="width: 60px; height: 60px;" loading="lazy">
                            <p class="mt-2 mb-0">Login sebagai <?php echo htmlspecialchars(ucfirst($_SESSION['username'])); ?></p>
                            <small>Admin Pakar DigNet 2.0</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="?module=bantuan">
                                <i class="fa-solid fa-circle-question me-2"></i> Bantuan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?module=tentang">
                                <i class="fa-solid fa-circle-info me-2"></i> Tentang
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="logout.php" onclick="return confirm('Anda yakin akan logout?');">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } else { ?>
                <!-- Guest Menu (Not Logged In) -->
                <li class="nav-item">
                    <a class="nav-link" href="?module=bantuan" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Bantuan penggunaan aplikasi">
                        <i class="fa-solid fa-circle-question"></i> <span class="d-none d-md-inline">Bantuan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?module=formlogin">
                        <i class="fa-solid fa-right-to-bracket"></i> <span class="d-none d-md-inline">Login</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>

        <!-- Main Sidebar (AdminLTE v4 / Bootstrap 5) -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">MENU UTAMA</li>
                        <?php include "menu.php"; ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Content Wrapper (AdminLTE v4 / Bootstrap 5) -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!-- Page headers can be added here by individual modules -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <?php include "content.php"; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Main Footer (AdminLTE v4 / Bootstrap 5) -->
        <footer class="main-footer">
            <div class="float-end d-none d-sm-inline">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalForm">
                    <i class="fa-solid fa-envelope"></i> Kontak Kami
                </button>
            </div>
            <strong>Copyright &copy; 2025 <a href="./">DigNet 2.0</a>.</strong>
            Sistem Pakar Diagnosis Gangguan IndiHome.
            
            <!-- Contact Modal (Bootstrap 5) -->
            <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="modalFormLabel">
                                <i class="fa-solid fa-envelope"></i> Kontak Kami
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="statusMsg"></p>
                            <form id="contactForm">
                                <div class="mb-3">
                                    <label for="masukkanNama" class="form-label">Nama:</label>
                                    <input type="text" class="form-control" id="masukkanNama" placeholder="Masukkan nama Anda" required>
                                </div>
                                <div class="mb-3">
                                    <label for="masukkanEmail" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="masukkanEmail" placeholder="Masukkan email Anda" required>
                                </div>
                                <div class="mb-3">
                                    <label for="masukkanPesan" class="form-label">Pesan:</label>
                                    <textarea class="form-control" id="masukkanPesan" rows="4" placeholder="Masukkan pesan Anda" required></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="button" class="btn btn-primary" onclick="kirimContactForm()">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.wrapper -->

    <?php if ($jsFile): ?>
        <!-- Production Build JS (Optimized & Minified by Vite) -->
        <script type="module" src="<?php echo $jsFile; ?>"></script>
        <!-- Chart.js CDN for pages with inline charts (before Vite lazy-loads it) -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js" crossorigin="anonymous"></script>
    <?php else: ?>
        <!-- Development Fallback: CDN Resources -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js" crossorigin="anonymous"></script>
    <?php endif; ?>
    
    <!-- CKEditor 5 (Modern WYSIWYG Editor) -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    
    <!-- Inline Critical JS (Sidebar toggle - needed immediately) -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar toggle functionality
        const pushMenuBtn = document.querySelector('[data-widget="pushmenu"]');
        const body = document.body;
        const mainSidebar = document.querySelector('.main-sidebar');
        const isMobile = () => window.innerWidth <= 991;
        
        if (pushMenuBtn) {
            pushMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                if (isMobile()) {
                    // On mobile: toggle sidebar-open class with animation
                    if (body.classList.contains('sidebar-open')) {
                        body.classList.remove('sidebar-animate');
                        setTimeout(() => body.classList.remove('sidebar-open'), 50);
                    } else {
                        body.classList.add('sidebar-open');
                        setTimeout(() => body.classList.add('sidebar-animate'), 50);
                    }
                } else {
                    // On desktop: toggle sidebar-collapse class
                    body.classList.toggle('sidebar-collapse');
                    try {
                        localStorage.setItem('sidebar-state', body.classList.contains('sidebar-collapse') ? 'collapsed' : 'open');
                    } catch(e) {}
                }
            });
        }
        
        // Close sidebar when clicking on overlay (mobile)
        document.addEventListener('click', function(e) {
            if (isMobile() && body.classList.contains('sidebar-open')) {
                // Check if click is outside sidebar
                if (mainSidebar && !mainSidebar.contains(e.target) && !pushMenuBtn.contains(e.target)) {
                    body.classList.remove('sidebar-animate');
                    setTimeout(() => body.classList.remove('sidebar-open'), 50);
                }
            }
        });
        
        // Restore sidebar state (desktop only)
        try {
            if (!isMobile() && localStorage.getItem('sidebar-state') === 'collapsed') {
                body.classList.add('sidebar-collapse');
            }
        } catch(e) {}
        
        // Handle window resize
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                if (isMobile()) {
                    // On mobile: ensure sidebar-open is removed when resizing to mobile
                    body.classList.remove('sidebar-open', 'sidebar-animate');
                }
            }, 100);
        });
        
        // Initialize Bootstrap tooltips
        const tooltipElements = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        if (typeof bootstrap !== 'undefined') {
            tooltipElements.forEach(el => new bootstrap.Tooltip(el));
        }
        
        // ==================== Smooth Treeview Dropdown Handler ====================
        // Custom smooth treeview toggle for nav-sidebar
        const treeviewLinks = document.querySelectorAll('.nav-sidebar .nav-item.has-treeview > .nav-link');
        
        treeviewLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                // Only prevent default if this is a treeview toggle (has children)
                const navItem = this.closest('.nav-item');
                const treeviewMenu = navItem ? navItem.querySelector('.nav-treeview') : null;
                
                if (treeviewMenu) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Close other open menus if accordion mode
                    const isAccordion = document.querySelector('[data-widget="treeview"][data-accordion="true"]');
                    if (isAccordion) {
                        document.querySelectorAll('.nav-sidebar .nav-item.menu-open').forEach(function(openItem) {
                            if (openItem !== navItem) {
                                openItem.classList.remove('menu-open', 'menu-is-opening');
                            }
                        });
                    }
                    
                    // Toggle current menu with smooth animation
                    if (navItem.classList.contains('menu-open')) {
                        navItem.classList.remove('menu-open');
                        navItem.classList.add('menu-is-closing');
                        setTimeout(() => navItem.classList.remove('menu-is-closing'), 400);
                    } else {
                        navItem.classList.add('menu-is-opening');
                        setTimeout(() => {
                            navItem.classList.add('menu-open');
                            navItem.classList.remove('menu-is-opening');
                        }, 50);
                    }
                }
            });
        });
        
        // Add smooth hover effects to all nav links
        const navLinks = document.querySelectorAll('.nav-sidebar .nav-link');
        navLinks.forEach(function(link) {
            // Add subtle ripple effect on click
            link.addEventListener('mousedown', function(e) {
                const rect = this.getBoundingClientRect();
                const ripple = document.createElement('span');
                ripple.style.cssText = `
                    position: absolute;
                    background: rgba(255,255,255,0.3);
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    left: ${e.clientX - rect.left - 10}px;
                    top: ${e.clientY - rect.top - 10}px;
                    transform: scale(0);
                    animation: ripple-effect 0.6s ease-out forwards;
                    pointer-events: none;
                `;
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });
        
        // Add ripple animation keyframes dynamically
        if (!document.getElementById('ripple-styles')) {
            const rippleStyles = document.createElement('style');
            rippleStyles.id = 'ripple-styles';
            rippleStyles.textContent = `
                @keyframes ripple-effect {
                    to {
                        transform: scale(15);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(rippleStyles);
        }
    });
    </script>
    
    <!-- Contact Form Handler (Vanilla JS - Optimized) -->
    <script>
    function kirimContactForm() {
        const reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        const nama = document.getElementById('masukkanNama').value.trim();
        const email = document.getElementById('masukkanEmail').value.trim();
        const pesan = document.getElementById('masukkanPesan').value.trim();
        const statusMsg = document.querySelector('.statusMsg');
        
        // Validation
        if (!nama) { alert('Masukkan nama Anda.'); document.getElementById('masukkanNama').focus(); return false; }
        if (!email) { alert('Masukkan email Anda.'); document.getElementById('masukkanEmail').focus(); return false; }
        if (!reg.test(email)) { alert('Masukkan email yang valid.'); document.getElementById('masukkanEmail').focus(); return false; }
        if (!pesan) { alert('Masukkan pesan Anda.'); document.getElementById('masukkanPesan').focus(); return false; }
        
        const formData = new FormData();
        formData.append('contactFrmSubmit', '1');
        formData.append('nama', nama);
        formData.append('email', email);
        formData.append('pesan', pesan);
        
        const submitBtn = document.querySelector('#modalForm .btn-primary');
        const modalBody = document.querySelector('#modalForm .modal-body');
        
        submitBtn.disabled = true;
        modalBody.style.opacity = '0.5';
        
        fetch('kirim_form.php', { method: 'POST', body: formData })
            .then(r => r.text())
            .then(data => {
                if (data.trim() === 'ok') {
                    document.getElementById('masukkanNama').value = '';
                    document.getElementById('masukkanEmail').value = '';
                    document.getElementById('masukkanPesan').value = '';
                    statusMsg.innerHTML = '<span class="text-success">Terima kasih telah menghubungi kami.</span>';
                } else {
                    statusMsg.innerHTML = '<span class="text-danger">Ada sedikit masalah, silakan coba lagi.</span>';
                }
            })
            .catch(err => { statusMsg.innerHTML = '<span class="text-danger">Error: ' + err.message + '</span>'; })
            .finally(() => { submitBtn.disabled = false; modalBody.style.opacity = '1'; });
    }
    </script>
</body>
</html>
<?php ob_end_flush(); ?>