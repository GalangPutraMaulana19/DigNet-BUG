<title>Tentang - DigNet 1.0</title>

<style>
/* Modern SaaS About Page Styling */
.about-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 1rem;
}

.about-hero {
    background: linear-gradient(135deg, #E21E2C 0%, #B71C1C 100%);
    border-radius: 24px;
    padding: 3rem 2rem;
    text-align: center;
    color: white;
    margin-bottom: 2rem;
    box-shadow: 0 20px 40px rgba(226, 30, 44, 0.3);
    position: relative;
    overflow: hidden;
}

.about-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    pointer-events: none;
}

.about-logo {
    width: 120px;
    height: 120px;
    background: white;
    border-radius: 24px;
    padding: 1rem;
    margin: 0 auto 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.about-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.about-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.about-version {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    padding: 0.375rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-top: 1rem;
}

/* Team Section */
.team-section {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-title i {
    color: #E21E2C;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.25rem;
}

.team-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #f0f1f3 100%);
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.team-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    border-color: #E21E2C;
}

.team-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #E21E2C 0%, #B71C1C 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.5rem;
}

.team-role {
    font-size: 0.75rem;
    font-weight: 600;
    color: #E21E2C;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.team-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.25rem;
}

.team-affiliation {
    font-size: 0.875rem;
    color: #6b7280;
}

/* Info Cards */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.info-card {
    background: white;
    border-radius: 20px;
    padding: 1.75rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border-left: 4px solid;
}

.info-card.primary { border-left-color: #E21E2C; }
.info-card.blue { border-left-color: #3B82F6; }
.info-card.green { border-left-color: #10B981; }
.info-card.orange { border-left-color: #F59E0B; }

.info-card-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-card.primary .info-card-title i { color: #E21E2C; }
.info-card.blue .info-card-title i { color: #3B82F6; }
.info-card.green .info-card-title i { color: #10B981; }
.info-card.orange .info-card-title i { color: #F59E0B; }

.info-card-content {
    color: #4b5563;
    line-height: 1.7;
    font-size: 0.9375rem;
}

.info-card-content ul {
    margin: 0;
    padding-left: 1.25rem;
}

.info-card-content li {
    margin-bottom: 0.5rem;
}

/* University Section */
.university-section {
    background: linear-gradient(135deg, #1e3a5f 0%, #0f2744 100%);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    color: white;
    margin-bottom: 2rem;
}

.university-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255,255,255,0.15);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

.university-name {
    font-size: 1.75rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.university-program {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 1rem;
}

.university-year {
    font-size: 0.875rem;
    opacity: 0.7;
}

/* Browser Support */
.browser-section {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.browser-icons {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 1rem;
    flex-wrap: wrap;
}

.browser-icon {
    width: 50px;
    height: 50px;
    background: #f3f4f6;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #6b7280;
    transition: all 0.3s ease;
}

.browser-icon:hover {
    background: #E21E2C;
    color: white;
    transform: scale(1.1);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .about-hero {
        padding: 2rem 1.5rem;
        border-radius: 16px;
    }
    
    .about-title {
        font-size: 1.75rem;
    }
    
    .about-subtitle {
        font-size: 1rem;
    }
    
    .about-logo {
        width: 100px;
        height: 100px;
    }
    
    .team-section, .info-card, .university-section, .browser-section {
        padding: 1.5rem;
        border-radius: 16px;
    }
    
    .section-title {
        font-size: 1.25rem;
    }
    
    .university-name {
        font-size: 1.375rem;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .team-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .about-container {
        padding: 0 0.5rem;
    }
    
    .about-hero {
        padding: 1.5rem 1rem;
    }
    
    .about-title {
        font-size: 1.5rem;
    }
    
    .team-section, .info-card, .university-section, .browser-section {
        padding: 1.25rem;
    }
    
    .browser-icons {
        gap: 1rem;
    }
    
    .browser-icon {
        width: 40px;
        height: 40px;
        font-size: 1.25rem;
    }
}
</style>

<div class="about-container">
    <!-- Hero Section -->
    <div class="about-hero">
        <div class="about-logo">
            <img src="gambar/admin/favicon.svg" alt="Logo DigNet" onerror="this.src='gambar/admin/favicon.png'">
        </div>
        <h1 class="about-title">DigNet</h1>
        <p class="about-subtitle">
            Sistem Pakar Diagnosis Gangguan IndiHome Berbasis Forward Chaining dan Certainty Factor
        </p>
        <span class="about-version">
            <i class="fa-solid fa-code-branch me-1"></i> Version 1.0
        </span>
    </div>
    
    <!-- Team Section -->
    <div class="team-section">
        <h2 class="section-title">
            <i class="fa-solid fa-users"></i> Tim Pengembang
        </h2>
        <div class="team-grid">
            <div class="team-card">
                <div class="team-icon">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div class="team-role">Peneliti</div>
                <div class="team-name">Galang Putra Maulana</div>
                <div class="team-affiliation">Mahasiswa Teknik Informatika</div>
            </div>
            <div class="team-card">
                <div class="team-icon">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="team-role">Pakar Domain</div>
                <div class="team-name">PT Mutiara Sentosa</div>
                <div class="team-affiliation">Mitra Telkom Akses</div>
            </div>
            <div class="team-card">
                <div class="team-icon">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div class="team-role">Dosen Pembimbing</div>
                <div class="team-name">[Nama Dosen]</div>
                <div class="team-affiliation">Universitas Bhayangkara Jakarta Raya</div>
            </div>
        </div>
    </div>
    
    <!-- Info Cards -->
    <div class="info-grid">
        <div class="info-card primary">
            <h3 class="info-card-title">
                <i class="fa-solid fa-lightbulb"></i> Latar Belakang
            </h3>
            <div class="info-card-content">
                IndiHome merupakan layanan triple play dari PT Telkom Indonesia yang memadukan akses internet berbasis fiber to the home (FTTH), layanan digital melalui perangkat set-top box (STB), dan telepon. Di wilayah Witel Bekasi, instalasi dilaksanakan melalui kerja sama Telkom Akses dengan mitra pelaksana seperti PT Mutiara Sentosa.
            </div>
        </div>
        
        <div class="info-card blue">
            <h3 class="info-card-title">
                <i class="fa-solid fa-triangle-exclamation"></i> Permasalahan
            </h3>
            <div class="info-card-content">
                Dalam praktik, masih dijumpai variasi hasil instalasi dan proses diagnosis yang bergantung pada pengalaman individu teknisi. Hal ini menyebabkan mean time to repair memanjang dan frekuensi kunjungan ulang meningkat selama masa retensi 60 hari.
            </div>
        </div>
        
        <div class="info-card green">
            <h3 class="info-card-title">
                <i class="fa-solid fa-check-circle"></i> Solusi
            </h3>
            <div class="info-card-content">
                Sistem pakar berbasis aturan IF-THEN dengan metode Forward Chaining dan Certainty Factor untuk mendiagnosis gangguan pada komponen IndiHome (ODP, ONT, STB, Telepon). Sistem ini dirancang sebagai alat bantu bagi teknisi provisioning.
            </div>
        </div>
        
        <div class="info-card orange">
            <h3 class="info-card-title">
                <i class="fa-solid fa-gears"></i> Metode
            </h3>
            <div class="info-card-content">
                <ul>
                    <li><strong>Forward Chaining:</strong> Inferensi dari gejala menuju diagnosis</li>
                    <li><strong>Certainty Factor:</strong> Menangani ketidakpastian dengan nilai -1 hingga +1</li>
                    <li><strong>Basis Pengetahuan:</strong> Dari teknisi assurance dan studi literatur</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- University Section -->
    <div class="university-section">
        <div class="university-badge">
            <i class="fa-solid fa-graduation-cap"></i> Tugas Akhir / Skripsi
        </div>
        <h2 class="university-name">Universitas Bhayangkara Jakarta Raya</h2>
        <p class="university-program">Program Studi Teknik Informatika</p>
        <p class="university-year">Copyright © 2025 - All Rights Reserved</p>
    </div>
    
    <!-- Browser Support -->
    <div class="browser-section">
        <h2 class="section-title" style="justify-content: center;">
            <i class="fa-solid fa-globe"></i> Browser yang Didukung
        </h2>
        <div class="browser-icons">
            <div class="browser-icon" title="Google Chrome">
                <i class="fa-brands fa-chrome"></i>
            </div>
            <div class="browser-icon" title="Mozilla Firefox">
                <i class="fa-brands fa-firefox-browser"></i>
            </div>
            <div class="browser-icon" title="Microsoft Edge">
                <i class="fa-brands fa-edge"></i>
            </div>
            <div class="browser-icon" title="Safari">
                <i class="fa-brands fa-safari"></i>
            </div>
            <div class="browser-icon" title="Opera">
                <i class="fa-brands fa-opera"></i>
            </div>
        </div>
    </div>
</div>
