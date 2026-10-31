<?php
require_once __DIR__ . '/../../Conection/get_all_kamar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Kamar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include __DIR__ . '/../../menu.php'; ?>
    <div class="container mt-4 mb-5">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h3 class="mb-0">Management Kamar</h3>
            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <h4 class="mb-0">Daftar Kamar</h4>

                    <a href="create.php" class="btn btn-primary">
                        + Tambah Kamar
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nomor Kamar</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Is Active</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>

                                    <td>
                                        <?= htmlspecialchars($row['nomor_kamar']); ?>
                                    </td>

                                    <td>
                                        Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($row['status_kamar'] == 0) {
                                            echo "Ready";
                                        } else {
                                            echo "Not Ready";
                                        }
                                        ?>
                                    </td>


                                    <td>
                                        <?php
                                        if ($row['is_active'] == 0) {
                                            echo "Active";
                                        } else {
                                            echo "Not active";
                                        }
                                        ?>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <!-- edit.php?id=1 -> dikirim ke eit.php -->
                                            <a href="edit.php?id=<?= $row['id']; ?>"
                                                class="btn btn-warning btn-sm">
                                                Edit
                                            </a>

                                            <?php if ($row['is_active'] == 0) { ?>
                                                <form action="../../Conection/delete_kamar.php" method="POST" id="delete-form<?= $row['id'] ?>">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                        onclick="konfirmasiHapus(event, <?= $row['id'] ?> ,'<?= htmlspecialchars($row['nomor_kamar'], ENT_QUOTES); ?>')">
                                                        Nonaktifkan</button>
                                                </form>
                                            <?php } else { ?>
                                                <form action="../../Conection/active_kamar.php" method="POST" id="active-form<?= $row['id'] ?>">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    <button class="btn btn-success btn-sm" type="button"
                                                        onclick="konfirmasiAktif(event, <?= $row['id'] ?> ,'<?= htmlspecialchars($row['nomor_kamar'], ENT_QUOTES); ?>')">
                                                        Aktifkan</button>
                                                </form>
                                            <?php } ?>

                                        </div>
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
    <script>
        function konfirmasiHapus(e, id, nomor) {
            e.preventDefault();
            Swal.fire({
                title: 'Nonaktifkan kamar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, nonaktifkan',
                cancelButtonText: 'Batal'
            }).then(r => {
                if (r.isConfirmed) document.getElementById("delete-form" + id).submit();
            });
        }

        function konfirmasiAktif(e, id, nomor) {
            e.preventDefault();
            Swal.fire({
                title: 'Aktif kamar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#349321',
                confirmButtonText: 'Ya, aktifkan',
                cancelButtonText: 'Batal'
            }).then(r => {
                if (r.isConfirmed) document.getElementById("active-form" + id).submit();
            });
        }
    </script>
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