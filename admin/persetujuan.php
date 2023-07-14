<?php
session_start();
if (!isset($_SESSION['teknisi_id'])) {
  header("Location: login.php");
  exit();
}
date_default_timezone_set('Asia/Jakarta');

include_once "../proses/koneksi.php";
$kon = new Koneksi();
$tampil = $kon->kueri("SELECT * FROM tb_peminjaman WHERE status = '0' ");

if (isset($_POST['sukses'])) {
  function getTanggalPeminjamanPengembalian($jedaHari)
  {
    $tanggalPeminjaman = date('d F Y');  // Tanggal peminjaman (hari ini) dalam format "tanggal bulan tahun"
    // Menambahkan jeda hari untuk tanggal pengembalian
    $tanggalPengembalian = date('d F Y', strtotime($tanggalPeminjaman . ' +' . $jedaHari . ' days'));

    // Jika tanggal pengembalian jatuh pada hari Sabtu atau Minggu, jadikan hari Senin
    $dayOfWeek = date('N', strtotime($tanggalPengembalian));
    if ($dayOfWeek >= 6) {
      $tanggalPengembalian = date('d F Y', strtotime($tanggalPengembalian . ' +2 days'));
    }

    // Mengubah bulan menjadi dalam bahasa Indonesia
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

    $tanggalPeminjaman = strtr($tanggalPeminjaman, $bulanIndonesia);
    $tanggalPengembalian = strtr($tanggalPengembalian, $bulanIndonesia);

    return [
      'tanggal_peminjaman' => $tanggalPeminjaman,
      'tanggal_pengembalian' => $tanggalPengembalian
    ];
  }

  // Contoh penggunaan: Mendapatkan tanggal peminjaman dan pengembalian dengan jeda 7 hari
  $hasil = getTanggalPeminjamanPengembalian(7);
  $tanggalPeminjaman = $hasil['tanggal_peminjaman'];
  $tanggalPengembalian = $hasil['tanggal_pengembalian'];

  // echo 'Tanggal Peminjaman: ' . $tanggalPeminjaman . '<br>';
  // echo 'Tanggal Pengembalian: ' . $tanggalPengembalian;

  $id = strip_tags($_POST['id']);
  $abc = $kon->kueri("UPDATE tb_peminjaman SET  tgl_pinjam='$tanggalPeminjaman',tgl_batas_kembali='$tanggalPengembalian', status = '1' WHERE id_pinjam = '$id' ");
  if ($abc == true) {
    $_SESSION['sukses'] = "1";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}

if (isset($_POST['tolak'])) {
  $id = strip_tags($_POST['id']);
  $kembalikanbarang = $kon->kueri("SELECT * FROM tb_peminjaman WHERE id_pinjam = '$id' ");
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



  $abc = $kon->kueri("UPDATE tb_peminjaman SET status = '3' WHERE id_pinjam = '$id' ");
  if ($abc == true) {
    $_SESSION['tolak'] = "1";
    header("Location: " . $_SERVER['PHP_SELF']);
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
            <h3>Persetujuan Peminjaman</h3>

          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Persetujuan Peminjaman</li>
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
                                        <strong>Peminjaman Disetujui !
                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                unset($_SESSION['sukses']);
              }
            }

            if (isset($_SESSION['tolak'])) {
              if ($_SESSION['tolak'] == 1) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Peminjaman Ditolak !
                                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>';
                unset($_SESSION['tolak']);
              }
            }

            ?>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>Nama Mahasiswa</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Spesifikasi</th>
                  <th>Kuantiti</th>
                  <th>Persetujuan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($tampil as $row) { ?>
                  <tr>
                    <td><?= $row['nama_mahasiswa'] ?></td>
                    <td><?= $row['kd_barang'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['merek'] ?></td>
                    <td><?= $row['kuantiti'] ?></td>
                    <td>
                      <form action="" method="POST" id="aksi">
                        <input type="hidden" name="id" value="<?= $row['id_pinjam'] ?>">
                        <button type="submit" class="btn btn-success" name="sukses"><i class="bi bi-check-circle"></i></button>
                        <button type="submit" class="btn btn-danger" name="tolak"><i class="bi bi-x-circle"></i></button>
                      </form>
                    </td>
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