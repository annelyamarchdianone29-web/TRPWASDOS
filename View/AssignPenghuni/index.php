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
</head>

<body>
    <?php include __DIR__ . '/../../menu.php'; ?>
    <h2><?= $is_pindah ? 'Pindah Kamar' : 'Assign Kamar'; ?></h2>

    <p>Penghuni: <strong><?= htmlspecialchars($info['nama_lengkap']); ?></strong></p>
    <?php if ($is_pindah) { ?>
        <p>Kamar saat ini: <strong><?= htmlspecialchars($info['nomor_kamar']); ?></strong></p>
    <?php } ?>

    <?php if (mysqli_num_rows($kamar) === 0) { ?>
        <p style="color:red;">Tidak ada kamar kosong.</p>
    <?php } else { ?>
        <form action="../../Conection/proses_assign.php" method="POST">
            <input type="hidden" name="id_assign" value="<?= $id_assign; ?>">

            <label>Pilih Kamar</label><br>
            <select name="id_kamar" required>
                <option value="">-- pilih kamar --</option>
                <?php while ($k = mysqli_fetch_assoc($kamar)) { ?>
                    <option value="<?= $k['id']; ?>">
                        <?= htmlspecialchars($k['nomor_kamar']); ?> - Rp <?= number_format($k['harga'], 0, ',', '.'); ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>

            <button type="submit"><?= $is_pindah ? 'Pindah' : 'Assign'; ?></button>
            <a href="../Penghuni/index.php">Batal</a>
        </form>
    <?php } ?>
</body>

</html>