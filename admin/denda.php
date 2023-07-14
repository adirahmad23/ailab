<?php
session_start();
if (!isset($_SESSION['teknisi_id'])) {
    header("Location: login.php");
    exit();
}
date_default_timezone_set('Asia/Jakarta');
include_once "../proses/koneksi.php";
$kon = new Koneksi();
if (isset($_GET['id'])) {
    $abc = $kon->kueri("SELECT
m.id_mahasiswa,
m.nama_mahasiswa,
m.denda,
p.id_pinjam,
p.kd_barang,
p.tgl_pinjam,
p.tgl_batas_kembali,
p.status
FROM
tb_mahasiswa m
INNER JOIN
tb_peminjaman p
ON
m.id_mahasiswa = p.id_mahasiswa
WHERE
m.denda > 0 AND m.id_mahasiswa = '$_GET[id]' AND status = '2'
");
} else {
    $abc = $kon->kueri("SELECT
m.id_mahasiswa,
m.nama_mahasiswa,
m.denda,
p.id_pinjam,
p.kd_barang,
p.tgl_pinjam,
p.tgl_batas_kembali,
p.status
FROM
tb_mahasiswa m
INNER JOIN
tb_peminjaman p
ON
m.id_mahasiswa = p.id_mahasiswa
WHERE
m.denda > 0 AND status = '2'
");
}


if (isset($_POST['proses'])) {
    $id = $_POST['proses'];
    $update = $kon->kueri("UPDATE tb_mahasiswa SET denda = '' WHERE id_mahasiswa = '$id' ");
    if ($update) {
        $_SESSION['sukses'] = 1;
        header("Location: denda.php");
        exit();
    } else {
        $_SESSION['gagal'] = 1;
        header("Location: denda.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "template/header.php" ?>

<body>
    <?php include_once "template/sidebar.php" ?>
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
                        <h3>Denda Peminjaman</h3>

                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Denda Peminjaman</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Data Persetujuan Peminjaman
                    </div>
                    <div class="card-header">
                        <?php
                        if (isset($_SESSION['sukses'])) {
                            if ($_SESSION['sukses'] == 1) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Pembayaran Denda Telah Berhasil !
                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                unset($_SESSION['sukses']);
                            }
                        }

                        if (isset($_SESSION['gagal'])) {
                            if ($_SESSION['gagal'] == 1) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Pembayaran Denda Tidak Berhasil  !
                                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>';
                                unset($_SESSION['gagal']);
                            }
                        }

                        ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Batas Kembali</th>
                                    <th>Jumlah Hari Keterlambatan</th>
                                    <th>Denda Pembayaran</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php foreach ($abc as $value) { ?>
                                    <tr>


                                        <td><?= $value['nama_mahasiswa'] ?></td>
                                        <td><?= $value['tgl_pinjam'] ?></td>
                                        <td><?= $value['tgl_batas_kembali'] ?></td>
                                        <td>
                                            <?php
                                            $tgl_sekarang = date('d F Y');
                                            $diff = strtotime($tgl_sekarang) - strtotime($value['tgl_batas_kembali']);
                                            $daysLate = ceil($diff / (60 * 60 * 24));
                                            echo $daysLate;
                                            ?>
                                            Hari
                                        </td>
                                        <td><?= $value['denda'] ?></td>
                                        <td>
                                            <?php echo '<button type="button" data-bs-toggle="modal" class="btn btn-success" data-bs-target="#hapus' . $value['id_mahasiswa'] . '"><i class="bi bi-check-circle"></i></button>'; ?>
                                        </td>

                                        <!-- modal-hapus -->
                                        <?php echo '<div class="modal fade" id="hapus' . $value['id_mahasiswa'] . '" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">'; ?>
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Denda Pembayaran!</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <h5>Terima denda keterlambatan peminjaman barang!</h5>
                                                    </center>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                    <form action="" method="POST">
                                                        <?php echo '<button type="submit" class="btn btn-primary" name="proses" value="' . $value['id_mahasiswa'] . ' " ">Terima</button>'; ?>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                    </div>
                    </tr>
                <?php } ?>
                </tbody>
                </table>
                </div>
        </div>
        </section>
    </div>


    <!-- end-modal-hapus -->
    <?php include_once 'template/footer.php' ?>
</body>

</html>