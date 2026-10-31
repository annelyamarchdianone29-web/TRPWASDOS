<?php
require_once __DIR__ . '/../../Conection/get_penghuni.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Penghuni</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include __DIR__ . '/../../menu.php'; ?>

    <div class="container mt-4 mb-5">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white py-3">
                <h3 class="mb-0">Management Penghuni</h3>
            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

                    <h4 class="mb-0">Daftar Penghuni</h4>

                    <a href="create.php" class="btn btn-primary">
                        + Tambah Penghuni
                    </a>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nomor Handphone</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Kamar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>

                                    <td>
                                        <?= htmlspecialchars($row['no_hp']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['nama_lengkap']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['email'] ?? ''); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['nomor_kamar'] ?? ''); ?>
                                    </td>

                                    <td class="text-center">
                                        <?php if ($row['id_kamar'] === null) { ?>
                                            <a href="../AssignPenghuni/index.php?id_assign=<?= $row['id_assign']; ?>"
                                                class="btn btn-success btn-sm px-3">
                                                ASSIGN
                                            </a>
                                        <?php } else { ?>
                                            <a href="../AssignPenghuni/index.php?id_assign=<?= $row['id_assign']; ?>"
                                                class="btn btn-warning btn-sm px-3">
                                                PINDAH
                                            </a>
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