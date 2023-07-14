<?php
session_start();
if (!isset($_SESSION['teknisi_id'])) {
    header("Location: login.php");
    exit();
}
date_default_timezone_set('Asia/Jakarta');
include_once "../proses/koneksi.php";
$kon = new Koneksi();
$idteknisi = $_SESSION['teknisi_id'];
$idPinjam = $_COOKIE['idPinjam'];
$tampil = $kon->kueri("SELECT * FROM tb_peminjaman WHERE id_pinjam = '$idPinjam' and status = '2'");
$array = $kon->hasil_data($tampil);

$idrfid = $array['id_rfid'];
$arraykdbarang = $array['kd_barang'];
// echo "<br>";
$kdbarangArr = explode(",", $array['kd_barang']);
$jumladatapinjam = count($kdbarangArr);

if (isset($_POST['add'])) {
    $kdbarang = $_POST['rfid'];
    if ($kdbarang == "") {
        echo "<script>alert('Kode Barang Tidak Boleh Kosong')</script>";
        echo "<script>window.location.href = 'proses_pengembalian.php'</script>";
    } else {
        $inven = $kon->kueri("SELECT * FROM tb_inventaris WHERE kd_barang = '$kdbarang'");
        $cekkode = $kon->kueri("SELECT kd_barang FROM tb_inventaris WHERE kd_barang = '$kdbarang'");
        $datacekkode = $kon->hasil_data($cekkode);
        $datainven = $kon->hasil_data($inven);
        if ($kdbarang != $datacekkode['kd_barang']) {
            echo "<script>alert('Kode Barang Tidak Ditemukan')</script>";
            echo "<script>window.location.href = 'proses_pengembalian.php'</script>";
        } else {
            $kdbaranginven = $datainven['kd_barang'];
            $namabaranginven = $datainven['nama_barang'];
            $idteknisi = $_SESSION['teknisi_id'];
            if ($inven == true) {
                $select = $kon->kueri("SELECT * FROM tb_pengembalian WHERE kd_barang = '$kdbaranginven' ");
                $data = $kon->jumlah_data($select);
                $jumlah = $kon->kueri("SELECT * FROM tb_pengembalian WHERE id_pinjam = '$idPinjam' ");
                $datajumlah = $kon->jumlah_data($jumlah);
                if ($data > 0) {
                    echo "<script>alert('Barang Sudah Ada Di List')</script>";
                    echo "<script>window.location.href = 'proses_pengembalian.php'</script>";
                } else if ($datajumlah >= $jumladatapinjam) {
                    echo "<script>alert('Tap Melebihi Jumlah Data Yang Dipinjam')</script>";
                    echo "<script>window.location.href = 'proses_pengembalian.php'</script>";
                } else {
                    $insert = $kon->kueri("INSERT INTO tb_pengembalian (id_pinjam, id_rfid, nama_barang, kd_barang, id_teknisi) 
            VALUES ('$idPinjam','$idrfid','$namabaranginven', '$kdbaranginven', '$idteknisi')");
                }
            }
        }
    }
}

if (isset($_POST['hapus'])) {
    $hapus_id = $_POST['hapus_id'];
    $kon->kueri("DELETE FROM tb_pengembalian WHERE id_kembali = '$hapus_id'");
    // Lakukan tindakan lain yang sesuai setelah menghapus data
}

if (isset($_POST['balik'])) {
    $jumlahData = 0; // Inisialisasi jumlah data
    for ($a = 0; $a < count($kdbarangArr); $a++) {
        $kdBarang = $kdbarangArr[$a];
        $view = $kon->kueri("SELECT * FROM tb_inventaris WHERE kd_barang = '$kdBarang'");
        $result = $kon->kueri("SELECT * FROM tb_inventaris WHERE kd_barang = '$kdBarang'");
        $jumlahpinjam = $kon->jumlah_data($result);
        $jumlahData += $jumlahpinjam;
    }
    $kembali = $kon->kueri("SELECT * FROM tb_pengembalian WHERE id_pinjam = '$idPinjam' and id_rfid = '$idrfid' and id_teknisi = '$idteknisi'");
    $jumlahkembali = $kon->jumlah_data($kembali);
    $data = [];
    while ($datakembali = $kon->hasil_data($kembali)) {
        $data[] = $datakembali['kd_barang'];
    }
    $hasil = implode(',', $data);
    // print_r($hasil);
    // die;
    if ($jumlahData == $jumlahkembali) {
        $array1 = array($arraykdbarang);
        $array2 = array($hasil);
        $array1 = array_values($array1);
        $array2 = array_values($array2);

        // Membandingkan kedua array
        $difference = array_diff($array1, $array2);

        if (empty($difference)) {
            $kembalikanbarang = $kon->kueri("SELECT * FROM tb_peminjaman WHERE id_pinjam = '$idPinjam' ");
            $var = $kon->hasil_data($kembalikanbarang);
            $kd = $var['kd_barang'];
            $pecahArr = explode(",", $kd);
            for ($i = 0; $i < count($pecahArr); $i++) {
                $kd_barang = $pecahArr[$i];
                $kembalikan = $kon->kueri("UPDATE tb_inventaris SET status='1',proses='1' WHERE kd_barang = '$kd_barang' ");
                if ($kembalikan == true) {
                    $count_data = $kon->kueri("SELECT status, merek, nama_barang, COUNT(*) as total FROM tb_inventaris GROUP BY status, merek, nama_barang");
                    while ($row = $kon->hasil_data($count_data)) {
                        $status = $row['status'];
                        $merek = $row['merek'];
                        $nama_barang = $row['nama_barang'];
                        $total = $row['total'];
                        //buatkan saya update ke tabel tb_barang hasil count masukan kedalam field stok tanpa marus membuka halaman ini lagi
                        $update =  $kon->kueri("UPDATE tb_barang SET stok = '$total' WHERE status = '$status' AND merek = '$merek' AND nama_barang = '$nama_barang'");
                    }
                }
            }

            $bulanIndonesia = [
                'January' => 'Januari',
                'February' => 'Februari',
                'March' => 'Maret',
                'April' => 'April',
                'May' => 'Mei',
                'June' => 'Juni',
                'July' => 'Juli',
                'August' => 'Agustus',
                'September' => 'September',
                'October' => 'Oktober',
                'November' => 'November',
                'December' => 'Desember'
            ];

            $tanggalSekarang = date('d F Y');
            $tanggalIndonesia = strtr($tanggalSekarang, $bulanIndonesia);

            $abc = $kon->kueri("UPDATE tb_peminjaman SET tgl_kembali = '$tanggalIndonesia', status = '4' WHERE id_pinjam = '$idPinjam' ");
            if ($abc == true) {
                $deletepengembalian = $kon->kueri("DELETE FROM tb_pengembalian WHERE id_pinjam = '$idPinjam' ");
                $_SESSION['kembali'] = "1";
                header("Location: pengembalian.php");
                exit();
            }
        } else {
            echo "<script>alert('Pengembalian Gagal Data, Pengembalian Berbeda')</script>";
            echo "<script>window.location.href = 'proses_pengembalian.php'</script>";
        }

        // $update = $kon->kueri("UPDATE tb_peminjaman SET status = '1' WHERE id_pinjam = '$idPinjam'");
        // echo "<script>alert('Pengembalian Berhasil')</script>";
        // echo "<script>window.location.href = 'pengembalian.php'</script>";
    } else {
        echo "<script>alert('Pengembalian Gagal, Data Yang Anda Tap Kurang')</script>";
        echo "<script>window.location.href = 'proses_pengembalian.php'</script>";
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
                        <h3>Pengembalian Peminjaman</h3>

                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pengembalian</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Data Pengembalian
                    </div>
                    <div>
                        <form action="" method="POST">
                            <div class="p-3">
                                <a href="pengembalian.php" class="btn btn-primary btn-lg"><i class="bi bi-arrow-return-left"></i></a>
                                <span></span>
                                <label id="ktmInput"></label>
                                <input type="submit" class="btn btn-primary" name="add" value="Cari Barang">
                                <p class="p-2">Otomatis Terisi Saat Tap RFID</p>

                            </div>
                        </form>
                    </div>
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>RFID Barang</th>
                                    <!-- <th>AKSI</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                for ($a = 0; $a < count($kdbarangArr); $a++) {
                                    $kdBarang = $kdbarangArr[$a];
                                    $view = $kon->kueri("SELECT * FROM tb_inventaris WHERE kd_barang = '$kdBarang'");
                                    foreach ($view as $row) {
                                ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['kd_barang'] ?></td>
                                        </tr>
                                <?php $no++;
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Data Tap Pengembalian
                    </div>
                    <div class="card-header">
                        <label>*Pastikan Anda Tap Sesuai Urutan List</label>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>RFID Barang</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tap = $kon->kueri("SELECT * FROM tb_pengembalian WHERE id_pinjam = '$idPinjam' and id_rfid = '$idrfid' and id_teknisi = '$idteknisi'");
                                foreach ($tap as $row) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['nama_barang'] ?></td>
                                        <td><?= $row['kd_barang'] ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="hapus_id" value="<?= $row['id_kembali'] ?>">
                                                <input type="submit" class="btn btn-danger" value="Hapus" name="hapus">
                                            </form>
                                        </td>
                                    </tr>
                                <?php $no++;
                                }

                                ?>

                            </tbody>
                        </table>
                        <form action="" method="post">
                            <input type="submit" class="btn btn-success" value="Kembalikan" name="balik">
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <!-- end-modal-hapus -->
        <?php include_once 'template/footer.php' ?>
</body>
<script>
    $(document).ready(function() {
        $("#ktmInput").load("tmpbalik.php");
        setInterval(function() {
            $("#ktmInput").load("tmpbalik.php");
        }, 500);
    });
</script>

</html>