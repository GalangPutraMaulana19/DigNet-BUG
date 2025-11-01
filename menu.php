<?php
$module = $_GET['module'] ?? '';
?>
<!-- Home Menu -->
<li class="nav-item">
    <a href="./" class="nav-link <?php if ($module == "") echo 'active'; ?>">
        <i class="nav-icon fa-solid fa-house"></i>
        <p>Beranda</p>
    </a>
</li>

<?php if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) { ?>
    <!-- Admin Menu (Logged In) -->
    <li class="nav-item">
        <a href="admin" class="nav-link <?php if ($module == "admin") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-user"></i>
            <p>Admin</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="repair" class="nav-link <?php if ($module == "repair") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-bug"></i>
            <p>Data Gangguan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="incident" class="nav-link <?php if ($module == "incident") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-droplet"></i>
            <p>Data Gejala</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="pengetahuan" class="nav-link <?php if ($module == "pengetahuan") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-flask"></i>
            <p>Basis Pengetahuan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="post" class="nav-link <?php if ($module == "post") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-file-lines"></i>
            <p>Post Keterangan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="password" class="nav-link <?php if ($module == "password") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-key"></i>
            <p>Ubah Password</p>
        </a>
    </li>
<?php } else { ?>
    <!-- User Menu (Not Logged In) -->
    <li class="nav-item">
        <a href="diagnosa" class="nav-link <?php if ($module == "diagnosa") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-magnifying-glass-plus"></i>
            <p>Diagnosa</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="riwayat" class="nav-link <?php if ($module == "riwayat") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
            <p>Riwayat</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="keterangan" class="nav-link <?php if ($module == "keterangan") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-comment"></i>
            <p>Keterangan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="harga" class="nav-link <?php if ($module == "harga") echo 'active'; ?>">
            <i class="nav-icon fa-solid fa-bookmark"></i>
            <p>Info Harga</p>
        </a>
    </li>
<?php } ?>

<!-- Common Menu -->
<li class="nav-item">
    <a href="tentang" class="nav-link <?php if ($module == "tentang") echo 'active'; ?>">
        <i class="nav-icon fa-solid fa-circle-info"></i>
        <p>Tentang</p>
    </a>
</li>