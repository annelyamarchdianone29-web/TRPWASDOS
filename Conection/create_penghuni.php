<?php
require_once __DIR__ . '/koneksi.php';

$pesan = '';

session_start();
if (isset($_POST['simpan'])) {
    $no_hp = trim($_POST['no_hp']);
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);

    $sql_cek = "SELECT id FROM m_penghuni WHERE no_hp = ?";
    $stmt_cek = mysqli_prepare($conn, $sql_cek);

    mysqli_stmt_bind_param($stmt_cek, "s", $no_hp);
    mysqli_stmt_execute($stmt_cek);

    $result_cek = mysqli_stmt_get_result($stmt_cek);

    if (mysqli_num_rows($result_cek) > 0) {
        $pesan = "Nomor HP sudah terdaftar!";
    } else {
        mysqli_begin_transaction($conn);

        try {
            $sql_penghuni = "INSERT INTO m_penghuni
                             (no_hp, nama_lengkap, email)
                             VALUES (?, ?, ?)";

            $stmt_penghuni = mysqli_prepare($conn, $sql_penghuni);

            mysqli_stmt_bind_param(
                $stmt_penghuni,
                "sss",
                $no_hp,
                $nama,
                $email
            );

            mysqli_stmt_execute($stmt_penghuni);

            $id_penghuni = mysqli_insert_id($conn);

            $sql_assign = "INSERT INTO t_assign_penghuni
                            (id_penghuni, id_kamar)
                            VALUES (?, NULL)";

            $stmt_assign = mysqli_prepare($conn, $sql_assign);

            mysqli_stmt_bind_param(
                $stmt_assign,
                "i",
                $id_penghuni
            );

            mysqli_stmt_execute($stmt_assign);

            mysqli_commit($conn);
            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'berhasil',
                'text' => 'kamar berhasil ditambahkan'
            ];
            header("Location: index.php");
            exit;
        } catch (mysqli_sql_exception $e) {
            mysqli_rollback($conn);
            $pesan = "Gagal menyimpan data penghuni. Periksa kembali struktur tabel." . $e;
        }
    }
}
