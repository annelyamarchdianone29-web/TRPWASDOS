<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Kamar</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0">Tambah Kamar</h4>
                    </div>

                    <div class="card-body p-4">
                        <form action="../../Conection/create_kamar.php" method="POST">

                            <p class="text-muted mb-4">
                                Silakan isi formulir berikut untuk menambahkan data kamar.
                            </p>

                            <?php if ($pesan_error != "") { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= htmlspecialchars($pesan_error); ?>
                                </div>
                            <?php } ?>


                            <div class="mb-3">
                                <label for="nomor_kamar" class="form-label">
                                    Nomor Kamar
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nomor_kamar"
                                    name="nomor_kamar"
                                    placeholder="Masukkan nomor kamar"
                                    value="<?= htmlspecialchars($_POST['nomor_kamar'] ?? ''); ?>"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">
                                    Harga
                                </label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="harga"
                                    name="harga"
                                    min="0"
                                    placeholder="Masukkan harga kamar"
                                    value="<?= htmlspecialchars($_POST['harga'] ?? ''); ?>"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">
                                    Status Kamar
                                </label>
                                <select
                                    class="form-select"
                                    id="status"
                                    name="status"
                                    required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="0"
                                        <?= (($_POST['status'] ?? '') === '0') ? 'selected' : ''; ?>>
                                        Ready
                                    </option>
                                    <option value="1"
                                        <?= (($_POST['status'] ?? '') === '1') ? 'selected' : ''; ?>>
                                        Not Ready
                                    </option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="is_active" class="form-label">
                                    Status Aktif
                                </label>
                                <select
                                    class="form-select"
                                    id="is_active"
                                    name="is_active"
                                    required>
                                    <option value="">-- Pilih Status Aktif --</option>
                                    <option value="0"
                                        <?= (($_POST['is_active'] ?? '') === '0') ? 'selected' : ''; ?>>
                                        Akctive
                                    </option>
                                    <option value="1"
                                        <?= (($_POST['is_active'] ?? '') === '1') ? 'selected' : ''; ?>>
                                        Not active
                                    </option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between gap-2">
                                <a href="index.php" class="btn btn-outline-secondary">
                                    Kembali
                                </a>

                                <button
                                    type="submit"
                                    name="simpan"
                                    class="btn btn-primary">
                                    Simpan Kamar
                                </button>
                            </div>
                    </div>
                    </form>
                </div>

                <p class="text-center text-muted mt-3 small">
                    Sistem Manajemen Kamar
                </p>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>