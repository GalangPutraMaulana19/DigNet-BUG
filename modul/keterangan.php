<title>Keterangan - DigNet 1.0</title>

<style>
/* Premium Keterangan Page Styles */
.keterangan-container {
    padding: 0 15px;
    max-width: 1400px;
    margin: 0 auto;
}

.keterangan-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 35px;
    color: white;
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
    position: relative;
    overflow: hidden;
}

.keterangan-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
    pointer-events: none;
}

.keterangan-header h2 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 12px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.keterangan-header p {
    font-size: 1.15rem;
    opacity: 0.95;
    margin-bottom: 0;
}

/* Search Bar Section */
.search-section {
    background: white;
    border-radius: 16px;
    padding: 25px 30px;
    margin-bottom: 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid rgba(102, 126, 234, 0.1);
}

.search-section h5 {
    color: #374151;
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.search-input-wrapper {
    position: relative;
    max-width: 600px;
}

.search-input-wrapper i {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 1.1rem;
}

.search-input {
    width: 100%;
    padding: 14px 18px 14px 50px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.search-input:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.search-input::placeholder {
    color: #9ca3af;
}

/* Stats Bar */
.stats-bar {
    display: flex;
    gap: 20px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 18px;
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    border-radius: 10px;
    font-size: 0.95rem;
    color: #4b5563;
}

.stat-item i {
    color: #667eea;
}

.stat-item strong {
    color: #374151;
}

/* Gangguan Cards Grid */
.gangguan-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 28px;
    margin-bottom: 40px;
}

.gangguan-card {
    background: white;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 4px 25px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(0,0,0,0.04);
    display: flex;
    flex-direction: column;
}

.gangguan-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
}

.gangguan-card-image {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.gangguan-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.gangguan-card:hover .gangguan-card-image img {
    transform: scale(1.08);
}

.gangguan-card-image .card-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255,255,255,0.95);
    color: #667eea;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.gangguan-card-image .placeholder-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 4rem;
    color: rgba(255,255,255,0.3);
}

.gangguan-card-body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.gangguan-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 12px;
    line-height: 1.4;
}

.gangguan-card-desc {
    color: #6b7280;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 20px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.gangguan-card-footer {
    display: flex;
    gap: 12px;
    margin-top: auto;
}

.btn-detail {
    flex: 1;
    padding: 12px 18px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none !important;
}

.btn-detail.primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white !important;
}

.btn-detail.primary:hover {
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    transform: translateY(-2px);
}

.btn-detail.success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white !important;
}

.btn-detail.success:hover {
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    transform: translateY(-2px);
}

/* Premium Modal Styles */
.premium-modal .modal-content {
    border-radius: 20px;
    border: none;
    overflow: hidden;
    box-shadow: 0 25px 60px rgba(0,0,0,0.3);
}

.premium-modal .modal-header {
    padding: 25px 30px;
    border-bottom: none;
}

.premium-modal .modal-header.detail-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.premium-modal .modal-header.saran-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.premium-modal .modal-title {
    font-size: 1.3rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
}

.premium-modal .modal-body {
    padding: 30px;
    color: #374151;
    font-size: 1rem;
    line-height: 1.8;
    text-align: justify;
    background: white;
}

.premium-modal .modal-footer {
    padding: 20px 30px;
    border-top: 1px solid #e5e7eb;
    background: #f9fafb;
}

.premium-modal .btn-close-modal {
    padding: 10px 25px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.premium-modal .btn-close-modal:hover {
    box-shadow: 0 4px 15px rgba(107, 114, 128, 0.4);
    transform: translateY(-2px);
}

/* No Image Placeholder */
.no-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.8);
}

.no-image-placeholder i {
    font-size: 3.5rem;
    margin-bottom: 10px;
    opacity: 0.7;
}

.no-image-placeholder span {
    font-size: 0.9rem;
    opacity: 0.6;
}

/* Responsive */
@media (max-width: 768px) {
    .keterangan-header {
        padding: 25px;
    }
    
    .keterangan-header h2 {
        font-size: 1.6rem;
    }
    
    .gangguan-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .gangguan-card-footer {
        flex-direction: column;
    }
    
    .stats-bar {
        flex-direction: column;
        gap: 10px;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.gangguan-card {
    animation: fadeInUp 0.6s ease forwards;
}

.gangguan-card:nth-child(1) { animation-delay: 0.1s; }
.gangguan-card:nth-child(2) { animation-delay: 0.2s; }
.gangguan-card:nth-child(3) { animation-delay: 0.3s; }
.gangguan-card:nth-child(4) { animation-delay: 0.4s; }
.gangguan-card:nth-child(5) { animation-delay: 0.5s; }
.gangguan-card:nth-child(6) { animation-delay: 0.6s; }
</style>

<div class="keterangan-container">
    <!-- Premium Header -->
    <div class="keterangan-header">
        <h2><i class="fa-solid fa-book-open me-3"></i>Keterangan Gangguan IndiHome</h2>
        <p>Informasi lengkap tentang berbagai jenis gangguan jaringan IndiHome beserta solusi penanganannya</p>
    </div>
    
    <!-- Search Section -->
    <div class="search-section">
        <h5><i class="fa-solid fa-magnifying-glass me-2"></i>Cari Jenis Gangguan</h5>
        <div class="search-input-wrapper">
            <i class="fa-solid fa-search"></i>
            <input type="text" class="search-input" id="searchGangguan" placeholder="Ketik nama gangguan yang ingin dicari...">
        </div>
        <div class="stats-bar">
            <?php
            $total = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM post"));
            ?>
            <div class="stat-item">
                <i class="fa-solid fa-folder-open"></i>
                <span>Total: <strong><?php echo $total; ?></strong> Jenis Gangguan</span>
            </div>
            <div class="stat-item">
                <i class="fa-solid fa-clock"></i>
                <span>Update: <strong><?php echo date('d M Y'); ?></strong></span>
            </div>
        </div>
    </div>
    
    <!-- Gangguan Cards Grid -->
    <div class="gangguan-grid" id="gangguanGrid">
        <?php
        $hasil = mysqli_query($conn,"SELECT * FROM post ORDER BY kode_post");
        $counter = 1;
        while ($r = mysqli_fetch_array($hasil)) {
            $gambar = $r['gambar'];
            $hasImage = !empty($gambar) && file_exists('gambar/' . $gambar);
        ?>
        
        <div class="gangguan-card" data-name="<?php echo strtolower($r['nama_post']); ?>">
            <div class="gangguan-card-image">
                <?php if ($hasImage): ?>
                    <img src="gambar/<?php echo $gambar; ?>" alt="<?php echo htmlspecialchars($r['nama_post']); ?>">
                <?php else: ?>
                    <div class="no-image-placeholder">
                        <i class="fa-solid fa-wifi"></i>
                        <span>Gambar Gangguan</span>
                    </div>
                <?php endif; ?>
                <span class="card-badge">
                    <i class="fa-solid fa-hashtag"></i> <?php echo $counter; ?>
                </span>
            </div>
            <div class="gangguan-card-body">
                <h3 class="gangguan-card-title"><?php echo htmlspecialchars($r['nama_post']); ?></h3>
                <p class="gangguan-card-desc"><?php echo htmlspecialchars(substr(strip_tags($r['det_post']), 0, 150)) . '...'; ?></p>
                <div class="gangguan-card-footer">
                    <a class="btn-detail primary" href="#" data-bs-toggle="modal" data-bs-target="#modal<?php echo $r['kode_post']; ?>">
                        <i class="fa-solid fa-eye"></i> Lihat Detail
                    </a>
                    <a class="btn-detail success" href="#" data-bs-toggle="modal" data-bs-target="#modaltindakan<?php echo $r['kode_post']; ?>">
                        <i class="fa-solid fa-lightbulb"></i> Saran Perbaikan
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Detail Modal -->
        <div class="modal fade premium-modal" id="modal<?php echo $r['kode_post'];?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header detail-header">
                        <h4 class="modal-title">
                            <i class="fa-solid fa-circle-info"></i>
                            Detail: <?php echo htmlspecialchars($r['nama_post']); ?>
                        </h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo $r['det_post']; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal">
                            <i class="fa-solid fa-times me-2"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Saran Modal -->
        <div class="modal fade premium-modal" id="modaltindakan<?php echo $r['kode_post'];?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header saran-header">
                        <h4 class="modal-title">
                            <i class="fa-solid fa-lightbulb"></i>
                            Saran Perbaikan: <?php echo htmlspecialchars($r['nama_post']); ?>
                        </h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo $r['srn_post']; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal">
                            <i class="fa-solid fa-times me-2"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <?php 
            $counter++;
        } 
        ?>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchGangguan').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase().trim();
    const cards = document.querySelectorAll('.gangguan-card');
    
    cards.forEach(function(card) {
        const name = card.getAttribute('data-name');
        if (name.includes(searchTerm)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>