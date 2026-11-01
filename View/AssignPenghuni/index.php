<?php
require_once __DIR__ . '/../../Conection/get_assign.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_pindah ? 'Pindah Kamar' : 'Assign Kamar'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/TRPWASDOS/Assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include __DIR__ . '/../../menu.php'; ?>

    <div class="container mt-4 mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h2 class="h3 mb-0"><?= $is_pindah ? 'Pindah Kamar' : 'Assign Kamar'; ?></h2>
            </div>

            <div class="card-body">
                <p class="mb-1">Penghuni: <strong><?= htmlspecialchars($info['nama_lengkap']); ?></strong></p>
                <?php if ($is_pindah) { ?>
                    <p>Kamar saat ini: <strong><?= htmlspecialchars($info['nomor_kamar']); ?></strong></p>
                <?php } ?>

                <?php if (mysqli_num_rows($kamar) === 0) { ?>
                    <div class="alert alert-danger mt-3 mb-3">Tidak ada kamar kosong.</div>
                    <a href="../Penghuni/index.php" class="btn btn-secondary">Kembali</a>
                <?php } else { ?>
                    <form action="../../Conection/proses_assign.php" method="POST" class="mt-3">
                        <input type="hidden" name="id_assign" value="<?= $id_assign; ?>">

                        <div class="mb-3">
                            <label for="id_kamar" class="form-label">Pilih Kamar</label>
                            <select name="id_kamar" id="id_kamar" class="form-select" required>
                                <option value="">-- pilih kamar --</option>
                                <?php while ($k = mysqli_fetch_assoc($kamar)) { ?>
                                    <option value="<?= $k['id']; ?>">
                                        <?= htmlspecialchars($k['nomor_kamar']); ?> - Rp <?= number_format($k['harga'], 0, ',', '.'); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <?= $is_pindah ? 'Pindah' : 'Assign'; ?>
                        </button>
                        <a href="../Penghuni/index.php" class="btn btn-secondary">Batal</a>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

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