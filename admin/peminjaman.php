<?php
session_start();
if (!isset($_SESSION["teknisi_id"])) {
    header("Location: login.php");
    exit;
}
include_once "../proses/koneksi.php";
$kon = new koneksi();
// $row = $kon->jumlah_row($kondisi);

?>
<!DOCTYPE html>
<html lang="en">

<?php include_once "template/header.php" ?>

<body>
    <?php include_once "template/sidebar.php" ?>
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
                        <h3>Daftar Mahasiswa Yang Melakukan Peminjaman</h3>
                        <!-- <p class="text-subtitle text-muted">Data Barang Yang Dipinjam</p> -->
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

                    <div class="card-body">
                        <form action="" method="POST" id="myForm">
                            <div class="p-3">
                                <label id="ktmInput"></label>
                                <input type="submit" class="btn btn-primary" name="cari" value="Cari Data">
                                <p class="p-2">Otomatis Terisi Saat Tap RFID</p>
                            </div>
                        </form>

                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Spesifikasi</th>
                                    <th>Kuantiti</th>
                                    <th>Tgl Peminjaman</th>
                                    <th>Tgl Batas Pengembalian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_POST['cari'])) {
                                    $no = 1;
                                    $ktm = $_POST['rfid'];
                                    $tampil = $kon->kueri("SELECT * FROM tb_peminjaman WHERE status = '0' OR status = '1' AND id_rfid = '$ktm' ");
                                    foreach ($tampil as $row) { ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['nama_mahasiswa'] ?></td>
                                            <td><?= $row['kd_barang'] ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['merek'] ?></td>
                                            <td><?= $row['kuantiti'] ?></td>
                                            <?php
                                            $status = $row['status'];
                                            if ($status == 0) {
                                                echo '<td>-</td>';
                                                echo '<td>-</td>';
                                            } else if ($status == 1) { ?>
                                                <td><?= $row['tgl_pinjam'] ?></td>
                                                <td><?= $row['tgl_batas_kembali'] ?></td>
                                            <?php  } ?>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                if ($status == 0) {
                                                    echo '<span class="badge bg-secondary">Menunggu Persetujuan</span>';
                                                } else if ($status == 1) {
                                                    echo '<span class="badge bg-success">Di Setujui</span>';
                                                }
                                                ?>
                                            <td>
                                                <?php if ($status == 1) { ?>
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm " onclick="setCookieAndRedirect(<?= $row['id_pinjam'] ?>)">
                                                        Proses Pinjam</a>
                                                    <script>
                                                        function setCookieAndRedirect(idPinjam) {
                                                            document.cookie = "idPinjam=" + idPinjam;
                                                            window.location.href = "proses_peminjaman.php";
                                                        }
                                                    </script>
                                                <?php  } ?>

                                            </td>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                    ?>
                                <?php  } else { ?>
                                    <?php $no = 1;
                                    $tampil = $kon->kueri("SELECT * FROM tb_peminjaman WHERE status = '0' OR status = '1'  ");
                                    foreach ($tampil as $row) {
                                    ?>

                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['nama_mahasiswa'] ?></td>
                                            <td><?= $row['kd_barang'] ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['merek'] ?></td>
                                            <td><?= $row['kuantiti'] ?></td>
                                            <?php
                                            $status = $row['status'];
                                            if ($status == 0) {
                                                echo '<td>-</td>';
                                                echo '<td>-</td>';
                                            } else if ($status == 1) { ?>
                                                <td><?= $row['tgl_pinjam'] ?></td>
                                                <td><?= $row['tgl_batas_kembali'] ?></td>
                                            <?php  } ?>
                                            <td>
                                                <?php
                                                $status = $row['status'];
                                                if ($status == 0) {
                                                    echo '<span class="badge bg-secondary">Menunggu Persetujuan</span>';
                                                } else if ($status == 1) {
                                                    echo '<span class="badge bg-success">Di Setujui</span>';
                                                }
                                                ?>
                                            <td>
                                                <?php if ($status == 1) { ?>
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm " onclick="setCookieAndRedirect(<?= $row['id_pinjam'] ?>)">
                                                        Proses Pinjam</a>
                                                    <script>
                                                        function setCookieAndRedirect(idPinjam) {
                                                            document.cookie = "idPinjam=" + idPinjam;
                                                            window.location.href = "proses_peminjaman.php";
                                                        }
                                                    </script>
                                                <?php  } ?>

                                            </td>
                                            </td>
                                        </tr>
                                <?php $no++;
                                    }
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <?php include_once 'template/footer.php' ?>
    </div>
    </div>
    <!-- <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script> -->
    <script>
        $(document).ready(function() {
            $("#ktmInput").load("tmpbalik.php");
            setInterval(function() {
                $("#ktmInput").load("tmpbalik.php");
            }, 500);
        });
    </script>
    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>

</body>

</html>