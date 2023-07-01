<?php
session_start();
if (!isset($_SESSION["teknisi_id"])) {
  header("Location: login.php");
  exit;
}
include_once "../proses/koneksi.php";
$kon = new koneksi();
$tampil = $kon->kueri("SELECT * FROM tb_peminjaman WHERE status = '3' OR status = '4' ORDER  BY id_pinjam DESC");
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
            <h3>Riwayat</h3>
            <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies
              thanks to simple-datatables</p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
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
                  <th>Nama Mahasiswa</th>
                  <th>ID RFID</th>
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
                    <td><?= $row['nama_mahasiswa'] ?></td>
                    <td><?= $row['id_rfid'] ?></td>
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
    <!-- end-modal-hapus -->
    <?php include_once 'template/footer.php' ?>
</body>

</html>