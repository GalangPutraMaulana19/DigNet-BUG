<?php
$module = $_GET['module'] ?? '';
?>
<!-- Home Menu -->
<li class="nav-item">
    <a href="./" class="nav-link <?php if ($module == "") echo 'active'; ?>" title="Beranda">
        <i class="nav-icon fa-solid fa-house"></i>
        <p>Beranda</p>
    </a>
</li>

<?php if (!empty($_SESSION['username'])) { ?>
    <!-- Admin Menu (Logged In) -->
    <li class="nav-item">
        <a href="?module=admin" class="nav-link <?php if ($module == "admin") echo 'active'; ?>" title="Admin">
            <i class="nav-icon fa-solid fa-user-shield"></i>
            <p>Admin</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="?module=repair" class="nav-link <?php if ($module == "repair") echo 'active'; ?>" title="Data Gangguan">
            <i class="nav-icon fa-solid fa-screwdriver-wrench"></i>
            <p>Data Gangguan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="?module=incident" class="nav-link <?php if ($module == "incident") echo 'active'; ?>" title="Data Gejala">
            <i class="nav-icon fa-solid fa-triangle-exclamation"></i>
            <p>Data Gejala</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="?module=pengetahuan" class="nav-link <?php if ($module == "pengetahuan") echo 'active'; ?>" title="Basis Pengetahuan">
            <i class="nav-icon fa-solid fa-brain"></i>
            <p>Basis Pengetahuan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="?module=post" class="nav-link <?php if ($module == "post") echo 'active'; ?>" title="Post Keterangan">
            <i class="nav-icon fa-solid fa-newspaper"></i>
            <p>Post Keterangan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="?module=password" class="nav-link <?php if ($module == "password") echo 'active'; ?>" title="Ubah Password">
            <i class="nav-icon fa-solid fa-key"></i>
            <p>Ubah Password</p>
        </a>
    </li>
<?php } else { ?>
    <!-- User Menu (Not Logged In) -->
    <li class="nav-item">
        <a href="?module=diagnosa" class="nav-link <?php if ($module == "diagnosa") echo 'active'; ?>" title="Diagnosa">
            <i class="nav-icon fa-solid fa-stethoscope"></i>
            <p>Diagnosa</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="?module=riwayat" class="nav-link <?php if ($module == "riwayat") echo 'active'; ?>" title="Riwayat">
            <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
            <p>Riwayat</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="?module=keterangan" class="nav-link <?php if ($module == "keterangan") echo 'active'; ?>" title="Keterangan">
            <i class="nav-icon fa-solid fa-book-open"></i>
            <p>Keterangan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="?module=harga" class="nav-link <?php if ($module == "harga") echo 'active'; ?>" title="Info Harga">
            <i class="nav-icon fa-solid fa-tags"></i>
            <p>Info Harga</p>
        </a>
    </li>
<?php } ?>

<!-- Common Menu -->
<li class="nav-item">
    <a href="?module=tentang" class="nav-link <?php if ($module == "tentang") echo 'active'; ?>" title="Tentang">
        <i class="nav-icon fa-solid fa-circle-info"></i>
        <p>Tentang</p>
    </a>
</li>