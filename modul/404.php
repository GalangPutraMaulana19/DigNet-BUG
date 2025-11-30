<?php
/**
 * 404 Not Found Page - Modern SaaS Premium Design
 * DigNet 2.0 - Sistem Pakar Diagnosis Gangguan IndiHome
 */
?>
<style>
/* 404 Page Premium SaaS Styling */
.error-404-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 70vh;
    text-align: center;
    padding: 40px 20px;
    position: relative;
    overflow: hidden;
}

/* Background Animation */
.error-404-container::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(circle at 20% 50%, rgba(226, 30, 44, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(102, 126, 234, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(118, 75, 162, 0.03) 0%, transparent 50%);
    animation: float-bg 20s ease-in-out infinite;
    z-index: -1;
}

@keyframes float-bg {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(2%, 2%) rotate(1deg); }
    66% { transform: translate(-2%, 1%) rotate(-1deg); }
}

/* 404 Number Animation */
.error-404-number {
    font-family: 'Space Grotesk', 'Inter', sans-serif;
    font-size: 180px;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 20px;
    position: relative;
    background: linear-gradient(135deg, #E21E2C 0%, #ff6b6b 50%, #E21E2C 100%);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradient-shift 3s ease infinite;
    text-shadow: none;
}

@keyframes gradient-shift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

/* Glitch Effect on Hover */
.error-404-number:hover {
    animation: gradient-shift 3s ease infinite, glitch 0.3s ease;
}

@keyframes glitch {
    0%, 100% { transform: translate(0); }
    20% { transform: translate(-2px, 2px); }
    40% { transform: translate(-2px, -2px); }
    60% { transform: translate(2px, 2px); }
    80% { transform: translate(2px, -2px); }
}

/* Network Icon Animation */
.error-404-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 30px;
    position: relative;
}

.error-404-icon svg {
    width: 100%;
    height: 100%;
}

.network-node {
    fill: #667eea;
    animation: pulse-node 2s ease-in-out infinite;
}

.network-node:nth-child(2) { animation-delay: 0.3s; }
.network-node:nth-child(3) { animation-delay: 0.6s; }
.network-node:nth-child(4) { animation-delay: 0.9s; }

.network-line {
    stroke: #E21E2C;
    stroke-width: 2;
    stroke-dasharray: 100;
    stroke-dashoffset: 100;
    animation: draw-line 2s ease forwards infinite;
}

.network-line:nth-child(2) { animation-delay: 0.5s; }
.network-line:nth-child(3) { animation-delay: 1s; }

@keyframes pulse-node {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(0.9); }
}

@keyframes draw-line {
    0% { stroke-dashoffset: 100; }
    50% { stroke-dashoffset: 0; }
    100% { stroke-dashoffset: -100; }
}

/* Title */
.error-404-title {
    font-family: 'Inter', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0 0 15px;
    letter-spacing: -0.5px;
}

/* Subtitle */
.error-404-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 18px;
    color: #666;
    margin: 0 0 10px;
    line-height: 1.6;
    max-width: 500px;
}

/* Description */
.error-404-description {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    color: #999;
    margin: 0 0 35px;
    line-height: 1.5;
}

/* Buttons Container */
.error-404-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 40px;
}

/* Primary Button */
.btn-404-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 32px;
    background: linear-gradient(135deg, #E21E2C 0%, #ff4757 100%);
    color: white;
    border: none;
    border-radius: 14px;
    font-size: 16px;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(226, 30, 44, 0.3);
    cursor: pointer;
}

.btn-404-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(226, 30, 44, 0.4);
    color: white;
}

.btn-404-primary:active {
    transform: translateY(-1px);
}

/* Secondary Button */
.btn-404-secondary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 32px;
    background: transparent;
    color: #667eea;
    border: 2px solid #e0e0e0;
    border-radius: 14px;
    font-size: 16px;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-404-secondary:hover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
    color: #764ba2;
    transform: translateY(-2px);
}

/* Quick Links Section */
.error-404-links {
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    border-radius: 20px;
    padding: 30px;
    max-width: 600px;
    width: 100%;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.error-404-links-title {
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: #1a1a2e;
    margin: 0 0 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.error-404-links-title i {
    color: #667eea;
}

.error-404-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 12px;
}

.quick-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 18px;
    background: white;
    border-radius: 12px;
    text-decoration: none;
    color: #333;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid #eee;
}

.quick-link:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.quick-link i {
    font-size: 16px;
    width: 20px;
    text-align: center;
}

.quick-link:hover i {
    color: white;
}

/* Floating Elements */
.floating-element {
    position: absolute;
    opacity: 0.1;
    animation: float 6s ease-in-out infinite;
}

.floating-element-1 {
    top: 10%;
    left: 10%;
    font-size: 60px;
    color: #E21E2C;
    animation-delay: 0s;
}

.floating-element-2 {
    top: 20%;
    right: 15%;
    font-size: 40px;
    color: #667eea;
    animation-delay: 1s;
}

.floating-element-3 {
    bottom: 20%;
    left: 15%;
    font-size: 50px;
    color: #764ba2;
    animation-delay: 2s;
}

.floating-element-4 {
    bottom: 15%;
    right: 10%;
    font-size: 45px;
    color: #E21E2C;
    animation-delay: 3s;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
}

/* Search Box */
.error-404-search {
    max-width: 400px;
    width: 100%;
    margin-bottom: 30px;
    position: relative;
}

.error-404-search input {
    width: 100%;
    padding: 16px 50px 16px 20px;
    border: 2px solid #e0e0e0;
    border-radius: 14px;
    font-size: 15px;
    font-family: 'Inter', sans-serif;
    transition: all 0.3s ease;
    background: white;
}

.error-404-search input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.error-404-search button {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 10px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.error-404-search button:hover {
    transform: translateY(-50%) scale(1.05);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .error-404-container {
        padding: 30px 15px;
        min-height: 60vh;
    }
    
    .error-404-number {
        font-size: 120px;
    }
    
    .error-404-icon {
        width: 80px;
        height: 80px;
    }
    
    .error-404-title {
        font-size: 24px;
    }
    
    .error-404-subtitle {
        font-size: 16px;
    }
    
    .error-404-description {
        font-size: 14px;
    }
    
    .error-404-buttons {
        flex-direction: column;
        width: 100%;
        max-width: 300px;
    }
    
    .btn-404-primary,
    .btn-404-secondary {
        width: 100%;
        justify-content: center;
        padding: 14px 24px;
        font-size: 15px;
    }
    
    .error-404-links {
        padding: 20px;
    }
    
    .error-404-links-grid {
        grid-template-columns: 1fr;
    }
    
    .floating-element {
        display: none;
    }
    
    .error-404-search {
        max-width: 100%;
    }
}

@media (max-width: 480px) {
    .error-404-number {
        font-size: 90px;
    }
    
    .error-404-title {
        font-size: 20px;
    }
    
    .error-404-subtitle {
        font-size: 14px;
    }
    
    .btn-404-primary,
    .btn-404-secondary {
        padding: 12px 20px;
        font-size: 14px;
        border-radius: 12px;
    }
}
</style>

<div class="error-404-container">
    <!-- Floating Background Elements -->
    <i class="fa-solid fa-wifi floating-element floating-element-1"></i>
    <i class="fa-solid fa-network-wired floating-element floating-element-2"></i>
    <i class="fa-solid fa-server floating-element floating-element-3"></i>
    <i class="fa-solid fa-signal floating-element floating-element-4"></i>
    
    <!-- Network Icon with Animation -->
    <div class="error-404-icon">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <!-- Network Lines -->
            <line class="network-line" x1="25" y1="25" x2="75" y2="25" />
            <line class="network-line" x1="50" y1="25" x2="50" y2="75" />
            <line class="network-line" x1="25" y1="75" x2="75" y2="75" />
            <!-- Network Nodes -->
            <circle class="network-node" cx="25" cy="25" r="8" />
            <circle class="network-node" cx="75" cy="25" r="8" />
            <circle class="network-node" cx="50" cy="50" r="10" style="fill: #E21E2C;" />
            <circle class="network-node" cx="25" cy="75" r="8" />
            <circle class="network-node" cx="75" cy="75" r="8" />
            <!-- X mark on center node -->
            <line x1="44" y1="44" x2="56" y2="56" stroke="white" stroke-width="3" stroke-linecap="round" />
            <line x1="56" y1="44" x2="44" y2="56" stroke="white" stroke-width="3" stroke-linecap="round" />
        </svg>
    </div>
    
    <!-- 404 Number -->
    <div class="error-404-number">404</div>
    
    <!-- Title -->
    <h1 class="error-404-title">Halaman Tidak Ditemukan</h1>
    
    <!-- Subtitle -->
    <p class="error-404-subtitle">
        Sepertinya koneksi ke halaman ini terputus. Halaman yang Anda cari mungkin telah dipindahkan atau tidak tersedia.
    </p>
    
    <!-- Description -->
    <p class="error-404-description">
        Kode Error: 404 | Waktu: <?php echo date('H:i:s'); ?>
    </p>
    
    <!-- Action Buttons -->
    <div class="error-404-buttons">
        <a href="./" class="btn-404-primary">
            <i class="fa-solid fa-house"></i>
            Kembali ke Beranda
        </a>
        <a href="?module=diagnosa" class="btn-404-secondary">
            <i class="fa-solid fa-stethoscope"></i>
            Mulai Diagnosa
        </a>
    </div>
    
    <!-- Quick Links -->
    <div class="error-404-links">
        <div class="error-404-links-title">
            <i class="fa-solid fa-compass"></i>
            Tautan Cepat
        </div>
        <div class="error-404-links-grid">
            <a href="./" class="quick-link">
                <i class="fa-solid fa-home"></i>
                Beranda
            </a>
            <a href="?module=diagnosa" class="quick-link">
                <i class="fa-solid fa-stethoscope"></i>
                Diagnosa
            </a>
            <a href="?module=tentang" class="quick-link">
                <i class="fa-solid fa-info-circle"></i>
                Tentang
            </a>
            <a href="?module=bantuan" class="quick-link">
                <i class="fa-solid fa-question-circle"></i>
                Bantuan
            </a>
            <?php if (isset($_SESSION['username']) && isset($_SESSION['password'])) { ?>
            <a href="?module=riwayat" class="quick-link">
                <i class="fa-solid fa-history"></i>
                Riwayat
            </a>
            <a href="?module=admin" class="quick-link">
                <i class="fa-solid fa-user-shield"></i>
                Admin
            </a>
            <?php } else { ?>
            <a href="?module=formlogin" class="quick-link">
                <i class="fa-solid fa-sign-in-alt"></i>
                Login
            </a>
            <a href="?module=harga" class="quick-link">
                <i class="fa-solid fa-tags"></i>
                Harga
            </a>
            <?php } ?>
        </div>
    </div>
</div>
