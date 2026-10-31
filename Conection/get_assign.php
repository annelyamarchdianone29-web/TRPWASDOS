<?php
require_once __DIR__ . '/koneksi.php';

session_start();
if (!isset($_GET['id_assign'])) {
    die("ID assign tidak ditemukan.");
}
$id_assign = (int) $_GET['id_assign'];

// info penghuni + kamar lama (kalau ada)
$stmt = mysqli_prepare($conn, "SELECT p.nama_lengkap, a.id_kamar, k.nomor_kamar
                               FROM t_assign_penghuni a
                               JOIN m_penghuni p ON p.id = a.id_penghuni
                               LEFT JOIN m_kamar k ON k.id = a.id_kamar
                               WHERE a.id = ?");
mysqli_stmt_bind_param($stmt, "i", $id_assign);
mysqli_stmt_execute($stmt);
$info = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$info) {
    die("Data assign tidak ditemukan.");
}

$is_pindah = $info['id_kamar'] !== null;

// hanya kamar kosong dan aktif  (sesuaikan nilai kalau beda)
$kamar = mysqli_query($conn, "SELECT id, nomor_kamar, harga
                              FROM m_kamar
                              WHERE status_kamar = 0 AND is_active = 0
                              ORDER BY nomor_kamar");
