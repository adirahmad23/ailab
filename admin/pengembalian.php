<?php
session_start();
if (!isset($_SESSION['teknisi_id'])) {
  header("Location: login.php");
  exit();
}
include_once "../proses/koneksi.php";
$kon = new Koneksi();

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
            <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables</p>
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
              <input type="text" name="ktm" placeholder="Tap RFID KTM">
              <p>Otomatis Terisi Saat Tap RFID</p>
              <input type="submit" name="cari" value="Cari Data">
            </form>
          </div>
          <div class="card-header">

          </div>
          <div class="card-body">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Mahasiswa</th>
                  <th>ID RFID</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                if (isset($_POST['cari'])) {
                  $ktm = $_POST['ktm'];
                  $tampil = $kon->kueri("SELECT * FROM tb_peminjaman WHERE id_rfid = '$ktm' AND status = '1' ");

                  foreach ($tampil as $row) {


                ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row['nama_mahasiswa'] ?></td>
                      <td><?= $row['id_rfid'] ?></td>
                      <td>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="setCookieAndRedirect(<?= $row['id_pinjam'] ?>)">Proses Pengembalian</a>

                        <script>
                          function setCookieAndRedirect(idPinjam) {
                            document.cookie = "idPinjam=" + idPinjam;
                            window.location.href = "proses_pengembalian.php";
                          }
                        </script>

                      </td>
                    </tr>
                <?php $no++;
                  }
                }
                ?>

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