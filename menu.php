<?php
// cek halaman yang sedang dibuka dari alamat URL-nya
$url = $_SERVER['SCRIPT_NAME'];

$aktif_kamar      = strpos($url, '/View/Kamar/') !== false;
$aktif_penghuni   = strpos($url, '/View/Penghuni/') !== false
    || strpos($url, '/View/AssignPenghuni/') !== false;
$aktif_pembayaran = strpos($url, '/View/Pembayaran/') !== false;
?>
<nav class="navbar navbar-expand navbar-dark bg-dark px-3">
    <span class="navbar-brand">Management Kos</span>
    <div class="navbar-nav">
        <a class="nav-link <?= $aktif_kamar ? 'active' : ''; ?>"
            href="/TRPWASDOS/View/Kamar/index.php">Kamar</a>

        <a class="nav-link <?= $aktif_penghuni ? 'active' : ''; ?>"
            href="/TRPWASDOS/View/Penghuni/index.php">Penghuni</a>

        <a class="nav-link <?= $aktif_pembayaran ? 'active' : ''; ?>"
            href="/TRPWASDOS/View/Pembayaran/index.php">Pembayaran</a>
    </div>
</nav>