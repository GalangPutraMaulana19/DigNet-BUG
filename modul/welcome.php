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

<!-- Premium Hero Section (Static - No Carousel) -->
<section class="hero-section-static" style="background: var(--gradient-primary); padding: 5rem 2rem 4rem; border-radius: var(--radius-2xl); margin-bottom: var(--space-8); box-shadow: var(--shadow-2xl); position: relative; overflow: hidden; align-self: flex-start; width: 100%;">
    <!-- Hero Content -->
    <div class="hero-content">
        <div class="hero-badge" style="display: inline-flex; align-items: center; gap: var(--space-2); padding: var(--space-2) var(--space-4); background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border-radius: var(--radius-full); font-size: 0.875rem; font-weight: 600; margin-bottom: var(--space-5);">
            <i class="fa-solid fa-star"></i>
            <span>Sistem Pakar Diagnosis Gangguan IndiHome</span>
        </div>
        <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 900; line-height: 1.1; margin-bottom: var(--space-4); text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);">
            Solusi Cepat & Akurat untuk<br>
            <span style="background: linear-gradient(135deg, #fff 0%, #e0e0e0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Diagnosis Gangguan IndiHome</span>
        </h1>
        <p class="hero-subtitle" style="font-size: clamp(1rem, 2vw, 1.25rem); font-weight: 400; line-height: 1.6; margin-bottom: var(--space-6); opacity: 0.95; max-width: 700px; margin-left: auto; margin-right: auto;">
            Sistem pakar berbasis Forward Chaining dan Certainty Factor untuk membantu teknisi provisioning mendiagnosis gangguan IndiHome selama masa retensi 60 hari dengan akurasi tinggi.
        </p>
        <div class="hero-cta" style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
            <a href="?module=diagnosa" class="btn btn-hero-primary" style="margin: 0.5rem;">
                <i class="fa-solid fa-stethoscope me-2"></i>
                Mulai Diagnosis
            </a>
            <a href="?module=bantuan" class="btn btn-hero-secondary" style="margin: 0.5rem;">
                <i class="fa-solid fa-circle-info me-2"></i>
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
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