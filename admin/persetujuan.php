<?php
session_start();
if (!isset($_SESSION['teknisi_id'])) {
  header("Location: login.php");
  exit();
}
include_once "../proses/koneksi.php";
$kon = new Koneksi();
$tampil = $kon->kueri("SELECT * FROM tb_peminjaman WHERE status = '0' ");

if (isset($_POST['sukses'])) {
  $id = strip_tags($_POST['id']);
  $abc = $kon->kueri("UPDATE tb_peminjaman SET status = '1' WHERE id_pinjam = '$id' ");
  if ($abc == true) {
    $_SESSION['sukses'] = "1";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}

if (isset($_POST['tolak'])) {
  $id = strip_tags($_POST['id']);
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
            <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables</p>
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
                  <th>Merek</th>
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

    <!-- modal-tambah -->
    <div class="modal" id="modal-tambah" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Persetujuan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>ID Mahasiswa</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Mahasiswa</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Barang</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <input type="text" name="id" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end-modal-tambah -->

    <!-- modal-edit -->
    <div class="modal" id="modal-edit" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Persetujuan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>ID Mahasiswa</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Mahasiswa</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Barang</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <input type="text" name="id" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end-modal-edit -->

    <!-- modal-hapus -->
    <div class="modal" id="modal-hapus" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Hapus Data Persetujuan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <center>
              <h4>Apakah anda ingin hapus data</h4>
              <h4>tersebut ?</h4>
            </center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Hapus</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end-modal-hapus -->
    <?php include_once 'template/footer.php' ?>
</body>

</html>