<title>Beranda - DigNet 1.0</title>

<?php 
  // Fetch statistics
  $htincident=mysqli_query($conn,"SELECT count(*) as total from incident");
  $dtincident=mysqli_fetch_assoc($htincident);
  
  $htrepair=mysqli_query($conn,"SELECT count(*) as total from repair");
  $dtrepair=mysqli_fetch_assoc($htrepair);
  
  $htpengetahuan=mysqli_query($conn,"SELECT count(*) as total from basis_pengetahuan");
  $dtpengetahuan=mysqli_fetch_assoc($htpengetahuan);
  
  $htadmin=mysqli_query($conn,"SELECT count(*) as total from admin");
  $dtadmin=mysqli_fetch_assoc($htadmin);
?>

<!-- Premium Hero Section with Carousel -->
<section class="hero-section" id="carousel-example-generic" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carousel-example-generic" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carousel-example-generic" data-bs-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="aset/banner/dignet.jpg" alt="DigNet - Sistem Pakar IndiHome">
        </div>
        <div class="carousel-item">
            <img src="aset/banner/dignet3.jpg" alt="DigNet - Diagnosis Gangguan">
        </div>
    </div>
    
    <!-- Hero Content Overlay -->
    <div class="hero-content">
        <div class="hero-badge">
            <i class="fa-solid fa-star"></i>
            <span>Sistem Pakar Diagnosis Gangguan IndiHome</span>
        </div>
        <h1 class="hero-title">
            Solusi Cepat & Akurat untuk<br>
            <span class="text-gradient">Diagnosis Gangguan IndiHome</span>
        </h1>
        <p class="hero-subtitle">
            Sistem pakar berbasis Forward Chaining dan Certainty Factor untuk membantu teknisi provisioning mendiagnosis gangguan IndiHome selama masa retensi 60 hari dengan akurasi tinggi.
        </p>
        <div class="hero-cta">
            <a href="?module=diagnosa" class="btn btn-hero-primary">
                <i class="fa-solid fa-stethoscope me-2"></i>
                Mulai Diagnosis
            </a>
            <a href="?module=bantuan" class="btn btn-hero-secondary">
                <i class="fa-solid fa-circle-info me-2"></i>
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-example-generic" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel-example-generic" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</section>

<!-- Premium Statistics Section -->
<section class="stats-section">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12 mb-4 fade-in-up">
            <div class="premium-info-box">
                <div class="info-icon">
                    <i class="fa-solid fa-wifi"></i>
                </div>
                <div class="info-number"><?php echo $dtincident["total"]; ?></div>
                <div class="info-label">Total Gejala</div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-12 mb-4 fade-in-up">
            <div class="premium-info-box">
                <div class="info-icon gradient-green">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="info-number"><?php echo $dtrepair["total"]; ?></div>
                <div class="info-label">Total Gangguan</div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-12 mb-4 fade-in-up">
            <div class="premium-info-box">
                <div class="info-icon gradient-blue">
                    <i class="fa-solid fa-brain"></i>
                </div>
                <div class="info-number"><?php echo $dtpengetahuan["total"]; ?></div>
                <div class="info-label">Basis Pengetahuan</div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-12 mb-4 fade-in-up">
            <div class="premium-info-box">
                <div class="info-icon gradient-yellow">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="info-number"><?php echo $dtadmin["total"]; ?></div>
                <div class="info-label">Admin Pakar</div>
            </div>
        </div>
    </div>
</section>

<!-- Premium Features Section -->
<section class="features-section">
    <div class="section-header">
        <div class="section-badge">Fitur Unggulan</div>
        <h2 class="section-title">Mengapa Memilih DigNet?</h2>
        <p class="section-description">
            Sistem pakar yang dirancang khusus untuk kebutuhan diagnosis gangguan IndiHome dengan teknologi modern dan akurat
        </p>
    </div>
    
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4 fade-in-up">
            <div class="premium-feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-mobile-screen-button" style="color: white; font-size: 2.5rem;"></i>
                </div>
                <h3 class="feature-title">Fully Responsive</h3>
                <p class="feature-description">
                    Dapat diakses dengan nyaman melalui desktop, tablet, dan smartphone. User interface yang adaptif memberikan pengalaman optimal di berbagai perangkat.
                </p>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4 fade-in-up">
            <div class="premium-feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-network-wired" style="color: white; font-size: 2.5rem;"></i>
                </div>
                <h3 class="feature-title">Diagnosis Akurat</h3>
                <p class="feature-description">
                    Menggunakan metode Forward Chaining dan Certainty Factor untuk memberikan hasil diagnosis yang akurat dengan nilai kepastian yang terukur.
                </p>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4 fade-in-up">
            <div class="premium-feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-database" style="color: white; font-size: 2.5rem;"></i>
                </div>
                <h3 class="feature-title">Basis Pengetahuan Lengkap</h3>
                <p class="feature-description">
                    Fitur admin pakar untuk mengelola basis pengetahuan secara dinamis, mengatur aturan diagnosis, dan nilai CF untuk setiap kombinasi gejala-gangguan.
                </p>
            </div>
        </div>
    </div>
</section>

<div></div>