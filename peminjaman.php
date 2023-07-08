<?php
session_start();
if (!isset($_SESSION["mahasiswa_id"])) {
    header("Location: login.php");
    exit;
}
$idmhsw = $_SESSION['mahasiswa_id'];
include_once "proses/koneksi.php";
$kon = new koneksi();
$kondisi = $kon->kueri("SELECT * FROM tb_peminjaman where id_mahasiswa = '$idmhsw' AND status != '3' AND status != '4' ");
$jumlah = $kon->jumlah_data($kondisi);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/css/pages/simple-datatables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include_once "sidebar.php" ?>
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
                        <h3>Peminjaman Barang</h3>

                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Peminjaman Barang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Data Peminjaman Barang
                    </div>
                    <!-- <div class="btn-tambah p-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah">Tambah Data Peminjaman</button>
                    </div> -->
                    <?php if ($jumlah > 0) { ?>
                        <div class="card-body table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Spesifikasi</th>
                                        <th>Kuantiti</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Batas Pengembalian</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <?php } else if ($jumlah == 0) { ?>
                        <div class="card-body table-responsive">
                            <table class="table table-striped display ">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Spesifikasi</th>
                                        <th>Kuantiti</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Batas Pengembalian</th>
                                        <th>Status</th>
                                    </tr>
                                    <tr>
                                        <td colspan="9" align="center">Anda Belum Meminjam</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </div>


        <!-- end-modal-hapus -->

        <?php include_once 'footer.php' ?>
        <?php include_once "app_ajax.php" ?>

</body>

</html>