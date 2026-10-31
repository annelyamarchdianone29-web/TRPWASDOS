<?php
require_once __DIR__ . '/koneksi.php';

session_start();
$sql_read = "SELECT
                p.id,
                p.no_hp,
                p.nama_lengkap,
                p.email,
                a.id AS id_assign,
                a.id_kamar,
                k.nomor_kamar
             FROM m_penghuni p
             LEFT JOIN t_assign_penghuni a
                ON p.id = a.id_penghuni
             LEFT JOIN m_kamar k
                ON k.id = a.id_kamar";

$result = mysqli_query($conn, $sql_read);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
