<title>Dashboard Admin - DigNet 2.0</title>

<?php 
session_start();
// Check if user is logged in as admin
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
}

// Fetch statistics
$htincident=mysqli_query($conn,"SELECT count(*) as total from incident");
$dtincident=mysqli_fetch_assoc($htincident);

$htrepair=mysqli_query($conn,"SELECT count(*) as total from repair");
$dtrepair=mysqli_fetch_assoc($htrepair);

$htpengetahuan=mysqli_query($conn,"SELECT count(*) as total from basis_pengetahuan");
$dtpengetahuan=mysqli_fetch_assoc($htpengetahuan);

$htadmin=mysqli_query($conn,"SELECT count(*) as total from admin");
$dtadmin=mysqli_fetch_assoc($htadmin);

// Get recent diagnosis history count
$htriwayat=mysqli_query($conn,"SELECT count(*) as total from hasil");
$dtriwayat=mysqli_fetch_assoc($htriwayat);

// Get post count
$htpost=mysqli_query($conn,"SELECT count(*) as total from post");
$dtpost=mysqli_fetch_assoc($htpost);
?>

<!-- Premium Dashboard Header -->
<div class="mb-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="text-primary mb-2">
                <i class="fa-solid fa-chart-line me-3"></i>
                Dashboard Admin
            </h2>
            <p class="text-muted" style="font-size: 1.1rem;">
                Selamat datang kembali, <strong><?php echo ucfirst($_SESSION['username']); ?></strong>! 
                Berikut adalah ringkasan sistem pakar DigNet.
            </p>
        </div>
        <div class="col-md-4 text-end">
            <div class="badge bg-primary" style="font-size: 0.9rem; padding: 0.5rem 1rem;">
                <i class="fa-solid fa-user-shield me-2"></i>
                Admin Pakar
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards Section -->
<div class="row mb-4">
    <!-- Total Gejala -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="premium-info-box" style="cursor: pointer;" onclick="location.href='?module=incident'">
            <div class="info-icon">
                <i class="fa-solid fa-wifi"></i>
            </div>
            <div class="info-number"><?php echo $dtincident["total"]; ?></div>
            <div class="info-label">Total Gejala</div>
            <div class="mt-2">
                <a href="?module=incident" class="text-decoration-none" style="font-size: 0.85rem; color: #E21E2C;">
                    Kelola Gejala <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Total Gangguan -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="premium-info-box" style="cursor: pointer;" onclick="location.href='?module=repair'">
            <div class="info-icon gradient-green">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>
            <div class="info-number"><?php echo $dtrepair["total"]; ?></div>
            <div class="info-label">Total Gangguan</div>
            <div class="mt-2">
                <a href="?module=repair" class="text-decoration-none" style="font-size: 0.85rem; color: #10b981;">
                    Kelola Gangguan <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Basis Pengetahuan -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="premium-info-box" style="cursor: pointer;" onclick="location.href='?module=pengetahuan'">
            <div class="info-icon gradient-blue">
                <i class="fa-solid fa-brain"></i>
            </div>
            <div class="info-number"><?php echo $dtpengetahuan["total"]; ?></div>
            <div class="info-label">Basis Pengetahuan</div>
            <div class="mt-2">
                <a href="?module=pengetahuan" class="text-decoration-none" style="font-size: 0.85rem; color: #3b82f6;">
                    Kelola Pengetahuan <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Admin Pakar -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="premium-info-box" style="cursor: pointer;" onclick="location.href='?module=admin'">
            <div class="info-icon gradient-yellow">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div class="info-number"><?php echo $dtadmin["total"]; ?></div>
            <div class="info-label">Admin Pakar</div>
            <div class="mt-2">
                <a href="?module=admin" class="text-decoration-none" style="font-size: 0.85rem; color: #f59e0b;">
                    Kelola Admin <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Additional Stats Row -->
<div class="row mb-5">
    <!-- Riwayat Diagnosis -->
    <div class="col-lg-6 col-md-6 col-12 mb-4">
        <div class="premium-info-box" style="cursor: pointer;" onclick="location.href='?module=riwayat'">
            <div class="info-icon" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div class="info-number"><?php echo $dtriwayat["total"]; ?></div>
            <div class="info-label">Riwayat Diagnosis</div>
            <div class="mt-2">
                <a href="?module=riwayat" class="text-decoration-none" style="font-size: 0.85rem; color: #8b5cf6;">
                    Lihat Riwayat <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Post Keterangan -->
    <div class="col-lg-6 col-md-6 col-12 mb-4">
        <div class="premium-info-box" style="cursor: pointer;" onclick="location.href='?module=post'">
            <div class="info-icon" style="background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <div class="info-number"><?php echo $dtpost["total"]; ?></div>
            <div class="info-label">Post Keterangan</div>
            <div class="mt-2">
                <a href="?module=post" class="text-decoration-none" style="font-size: 0.85rem; color: #ec4899;">
                    Kelola Post <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: var(--radius-xl);">
            <div class="card-header bg-white" style="border-bottom: 1px solid #e5e7eb; padding: 1.5rem;">
                <h4 class="mb-0">
                    <i class="fa-solid fa-bolt text-warning me-2"></i>
                    Aksi Cepat
                </h4>
            </div>
            <div class="card-body" style="padding: 2rem;">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <a href="?module=incident&act=tambah" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #E21E2C 0%, #b91c1c 100%); color: white; border: none; padding: 1.2rem; border-radius: var(--radius-lg); box-shadow: 0 4px 12px rgba(226, 30, 44, 0.3); transition: all 0.3s ease;">
                            <i class="fa-solid fa-plus-circle d-block mb-2" style="font-size: 2rem;"></i>
                            <strong>Tambah Gejala</strong>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <a href="?module=repair&act=tambah" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 1.2rem; border-radius: var(--radius-lg); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); transition: all 0.3s ease;">
                            <i class="fa-solid fa-screwdriver-wrench d-block mb-2" style="font-size: 2rem;"></i>
                            <strong>Tambah Gangguan</strong>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <a href="?module=pengetahuan&act=tambah" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; padding: 1.2rem; border-radius: var(--radius-lg); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); transition: all 0.3s ease;">
                            <i class="fa-solid fa-brain d-block mb-2" style="font-size: 2rem;"></i>
                            <strong>Tambah Pengetahuan</strong>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <a href="?module=admin&act=tambah" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 1.2rem; border-radius: var(--radius-lg); box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3); transition: all 0.3s ease;">
                            <i class="fa-solid fa-user-plus d-block mb-2" style="font-size: 2rem;"></i>
                            <strong>Tambah Admin</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- System Information Section -->
<div class="row">
    <div class="col-lg-6 col-12 mb-4">
        <div class="card shadow-sm border-0" style="border-radius: var(--radius-xl); height: 100%;">
            <div class="card-header bg-white" style="border-bottom: 1px solid #e5e7eb; padding: 1.5rem;">
                <h5 class="mb-0">
                    <i class="fa-solid fa-info-circle text-primary me-2"></i>
                    Informasi Sistem
                </h5>
            </div>
            <div class="card-body" style="padding: 2rem;">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="color: #6b7280; font-weight: 500;">Versi Sistem</span>
                        <span style="color: #111827; font-weight: 600;">DigNet 2.0</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="color: #6b7280; font-weight: 500;">Metode Diagnosis</span>
                        <span style="color: #111827; font-weight: 600;">Forward Chaining & CF</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="color: #6b7280; font-weight: 500;">Admin Login</span>
                        <span style="color: #111827; font-weight: 600;"><?php echo ucfirst($_SESSION['username']); ?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="color: #6b7280; font-weight: 500;">Total Data Sistem</span>
                        <span style="color: #111827; font-weight: 600;">
                            <?php echo ($dtincident["total"] + $dtrepair["total"] + $dtpengetahuan["total"] + $dtriwayat["total"]); ?> Records
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 col-12 mb-4">
        <div class="card shadow-sm border-0" style="border-radius: var(--radius-xl); height: 100%;">
            <div class="card-header bg-white" style="border-bottom: 1px solid #e5e7eb; padding: 1.5rem;">
                <h5 class="mb-0">
                    <i class="fa-solid fa-chart-pie text-success me-2"></i>
                    Statistik Data
                </h5>
            </div>
            <div class="card-body" style="padding: 2rem;">
                <?php
                $total_data = $dtincident["total"] + $dtrepair["total"] + $dtpengetahuan["total"];
                if ($total_data > 0) {
                    $pct_gejala = round(($dtincident["total"] / $total_data) * 100, 1);
                    $pct_gangguan = round(($dtrepair["total"] / $total_data) * 100, 1);
                    $pct_pengetahuan = round(($dtpengetahuan["total"] / $total_data) * 100, 1);
                } else {
                    $pct_gejala = 0;
                    $pct_gangguan = 0;
                    $pct_pengetahuan = 0;
                }
                ?>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: #6b7280;">Gejala</span>
                        <span style="color: #E21E2C; font-weight: 600;"><?php echo $pct_gejala; ?>%</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 5px;">
                        <div class="progress-bar" style="width: <?php echo $pct_gejala; ?>%; background: linear-gradient(90deg, #E21E2C 0%, #b91c1c 100%);"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: #6b7280;">Gangguan</span>
                        <span style="color: #10b981; font-weight: 600;"><?php echo $pct_gangguan; ?>%</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 5px;">
                        <div class="progress-bar" style="width: <?php echo $pct_gangguan; ?>%; background: linear-gradient(90deg, #10b981 0%, #059669 100%);"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: #6b7280;">Pengetahuan</span>
                        <span style="color: #3b82f6; font-weight: 600;"><?php echo $pct_pengetahuan; ?>%</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 5px;">
                        <div class="progress-bar" style="width: <?php echo $pct_pengetahuan; ?>%; background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Helpful Tips Section -->
<div class="row">
    <div class="col-12">
        <div class="alert" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border: none; border-radius: var(--radius-xl); padding: 1.5rem;">
            <h5 class="mb-3" style="color: #1e40af;">
                <i class="fa-solid fa-lightbulb me-2"></i>
                Tips Penggunaan Dashboard
            </h5>
            <ul class="mb-0" style="color: #1e3a8a; line-height: 1.8;">
                <li>Gunakan <strong>Aksi Cepat</strong> untuk menambahkan data baru dengan cepat</li>
                <li>Klik pada kartu statistik untuk melihat detail lengkap setiap data</li>
                <li>Kelola basis pengetahuan secara berkala untuk meningkatkan akurasi diagnosis</li>
                <li>Monitor riwayat diagnosis untuk analisis pola gangguan yang sering terjadi</li>
            </ul>
        </div>
    </div>
</div>

<style>
/* Hover effects for action buttons */
a.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2) !important;
}

/* Hover effects for info boxes */
.premium-info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}
</style>
