<?php
require_once __DIR__ . '/koneksi.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses tidak valid.");
}

$id_pembayaran = (int) ($_POST['id_pembayaran'] ?? 0);

if ($id_pembayaran === 0) {
    die("Data tidak lengkap.");
}

$stmt = mysqli_prepare($conn, "UPDATE t_pembayaran
                               SET status = 1
                               WHERE id = ? AND status = 0");
mysqli_stmt_bind_param($stmt, "i", $id_pembayaran);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    $_SESSION['alert'] = [
        'icon' => 'success',
        'title' => 'berhasil',
        'text' => 'pembayaran berhasil dikonfirmasi'
    ];
} else {
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'gagal',
        'text' => 'pembayaran sudah dikonfirmasi atau tidak ditemukan'
    ];
}

header("Location: ../View/Pembayaran/index.php");
exit;
