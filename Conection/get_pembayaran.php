<?php
require_once __DIR__ . '/koneksi.php';

session_start();
$sql = "SELECT
            b.id,
            b.kode_transaksi,
            b.status,
            b.nominal_pembayaran,
            h.nama_lengkap,
            k.nomor_kamar,
            k.harga
        FROM t_pembayaran b
        JOIN t_assign_penghuni a ON a.id = b.id_t_assign_penghuni
        JOIN m_penghuni h ON h.id = a.id_penghuni
        JOIN m_kamar k ON k.id = a.id_kamar
        ORDER BY b.id ASC";

$result = mysqli_query($conn, $sql);
