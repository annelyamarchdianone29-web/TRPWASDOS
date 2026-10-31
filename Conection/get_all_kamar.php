<?php
require_once __DIR__ . '/koneksi.php';

session_start();
$sql_read = "SELECT * FROM m_kamar";
$result = mysqli_query($conn, $sql_read);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
