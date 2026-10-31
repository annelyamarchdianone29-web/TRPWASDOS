<?php
require_once __DIR__ . '/koneksi.php';

$pesan_error = "";
session_start();
if (isset($_POST['simpan'])) {
    $nomor_kamar = trim($_POST['nomor_kamar']);
    $harga = $_POST['harga'];
    $status_kamar = $_POST['status'];
    $is_active = $_POST['is_active'];

    $sql_cek = "SELECT id FROM m_kamar WHERE nomor_kamar = ?";
    $stmt_cek = mysqli_prepare($conn, $sql_cek);
    mysqli_stmt_bind_param($stmt_cek, "s", $nomor_kamar);
    mysqli_stmt_execute($stmt_cek);

    $result_cek = mysqli_stmt_get_result($stmt_cek);

    if (mysqli_num_rows($result_cek) > 0) {
        $pesan_error = "Nomor kamar sudah terdaftar!";
    } else {
        $sql_insert = "INSERT INTO m_kamar
                       (nomor_kamar, harga, status_kamar, is_active)
                       VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql_insert);

        mysqli_stmt_bind_param(
            $stmt,
            "siii",
            $nomor_kamar,
            $harga,
            $status_kamar,
            $is_active
        );

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'berhasil',
                'text' => 'kamar berhasil ditambahkan'
            ];
            header("Location: index.php");
            exit;
        } else {
            $pesan_error = "Gagal menyimpan data kamar.";
        }
    }
}
