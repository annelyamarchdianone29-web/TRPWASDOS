<?php
require_once __DIR__ . '/koneksi.php';

session_start();
if (isset($_POST['id'])) {
    $id_target = (int) $_POST['id'];

    $sql_update = "UPDATE m_kamar
                   SET is_active = 0
                   WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt, "i", $id_target);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'berhasil',
            'text' => 'kamar berhasil diaktifkan'
        ];
        header("Location: ../View/Kamar/index.php");
        exit;
    } else {
        die("Gagal mengaktifkan kamar.");
    }
} else {
    die("ID kamar tidak ditemukan.");
}
