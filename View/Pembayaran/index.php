<?php
require_once __DIR__ . '/../../Conection/get_pembayaran.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/TRPWASDOS/Assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include __DIR__ . '/../../menu.php'; ?>

    <div class="container mt-4 mb-5">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-primary text-white py-3">
                <h3 class="mb-0">Management Pembayaran</h3>
            </div>

            <div class="card-body">

                <div class="mb-4">
                    <h4 class="mb-0">Daftar Pembayaran</h4>
                </div>

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Penghuni</th>
                                <th>Kamar</th>
                                <th>Harga Kamar</th>
                                <th>Status</th>
                                <th>Nominal Dibayar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td class="fw-semibold">
                                        <?= htmlspecialchars($row['kode_transaksi']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['nama_lengkap']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['nomor_kamar']); ?>
                                    </td>

                                    <td>
                                        Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                                    </td>

                                    <td>
                                        <?php if ($row['status'] == 1) { ?>
                                            <span class="badge bg-success px-3 py-2">
                                                Paid
                                            </span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger px-3 py-2">
                                                Unpaid
                                            </span>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?= $row['nominal_pembayaran'] !== null
                                            ? 'Rp ' . number_format($row['nominal_pembayaran'], 0, ',', '.')
                                            : '-'; ?>
                                    </td>

                                    <td class="text-center">
                                        <?php if ($row['status'] == 0) { ?>
                                            <form action="../../Conection/proses_bayar.php" method="POST">

                                                <input type="hidden" name="id_pembayaran"
                                                    value="<?= $row['id']; ?>">

                                                <button type="submit" class="btn btn-success btn-sm px-3">
                                                    Konfirmasi Bayar
                                                </button>

                                            </form>
                                        <?php } else { ?>
                                            <span class="text-secondary">-</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (isset($_SESSION['alert'])): ?>
        <script>
            Swal.fire({
                icon: '<?= $_SESSION['alert']['icon'] ?>',
                title: <?= json_encode($_SESSION['alert']['title']) ?>,
                text: <?= json_encode($_SESSION['alert']['text']) ?>,
                confirmButtonColor: '#349321',
                confirmButtonText: 'OK',
                timer: 2500
            })
        </script>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>
</body>

</html>