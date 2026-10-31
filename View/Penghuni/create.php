<?php
require_once __DIR__ . '/../../Conection/create_penghuni.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Penghuni</title>

    <!-- Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm border-0">

                    <!-- Header -->
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0">Tambah Penghuni</h4>
                    </div>

                    <!-- Form -->
                    <div class="card-body p-4">
                        <form method="POST">

                            <p class="text-muted mb-4">
                                Silakan isi formulir berikut untuk menambahkan data penghuni.
                            </p>

                            <!-- Nomor HP -->
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">
                                    Nomor HP
                                </label>

                                <input
                                    type="tel"
                                    class="form-control"
                                    id="no_hp"
                                    name="no_hp"
                                    placeholder="Masukkan nomor HP"
                                    value="<?= htmlspecialchars($_POST['no_hp'] ?? ''); ?>"
                                    required>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="nama"
                                    name="nama"
                                    placeholder="Masukkan nama lengkap"
                                    value="<?= htmlspecialchars($_POST['nama'] ?? ''); ?>"
                                    required>
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label">
                                    Email
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    rows="3"
                                    placeholder="Masukkan email"
                                    value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>"
                                    required>
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between gap-2">

                                <a
                                    href="index.php"
                                    class="btn btn-outline-secondary">
                                    Batal
                                </a>

                                <button
                                    type="submit"
                                    name="simpan"
                                    class="btn btn-primary">
                                    Simpan Penghuni
                                </button>

                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JavaScript -->
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