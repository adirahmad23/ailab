<?php
session_start();
if (!isset($_SESSION["mahasiswa_id"])) {
    header("Location: login.php");
    exit;
}
$idmhsw = $_SESSION['mahasiswa_id'];
include_once "proses/koneksi.php";
$kon = new koneksi();
$tampil = $kon->kueri("SELECT * FROM tb_peminjaman WHERE id_mahasiswa = '$idmhsw' AND (status = '3' OR status = '4')");
// $row = $kon->jumlah_row($kondisi);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/css/pages/simple-datatables.css">

</head>

<body>
    <?php include_once "sidebar.php" ?>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Riwayat Pinjaman</h3>
                        <p class="text-subtitle text-muted">Data Barang Yang Anda Ajukan</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Data Riwayat
                    </div>

                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Spesifikasi</th>
                                    <th>Kuantiti</th>
                                    <th>Tgl Peminjaman</th>
                                    <th>Tgl Pengembalian</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($tampil as $row) {
                                ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['nama_barang'] ?></td>
                                        <td><?= $row['merek'] ?></td>
                                        <td><?= $row['kuantiti'] ?></td>
                                        <td><?= $row['tgl_pinjam'] ?></td>
                                        <td><?= $row['tgl_kembali'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['status'] == 4) {
                                                echo "<span class='badge bg-success'>Peminjaman Selesai</span>";
                                            }
                                            if ($row['status'] == 3) {
                                                echo "<span class='badge bg-danger'>Peminjaman ditolak</span>";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <?php include_once 'footer.php' ?>
    </div>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>

</body>

</html>