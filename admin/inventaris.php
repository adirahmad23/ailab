<?php
session_start();
if (!isset($_SESSION['teknisi_id'])) {
  header("Location: login.php");
  exit();
}
include_once "../proses/koneksi.php";
$kon = new Koneksi();
$tampil = $kon->kueri("SELECT * FROM tb_inventaris");
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
            <h3>Inventaris Barang</h3>
            <p class="text-subtitle text-muted">Silahkan Pilih Barang Yang Akan Anda Pinjam</p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Inventaris Barang</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <section class="section">
        <div class="card">
          <div class="card-header">
            Data List Barang
          </div>
          <div class="btn-tambah p-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah">Tambah Inventaris</button>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Merek</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($tampil as $value) : ?>
                  <tr>
                    <td><?= $value['kd_barang'] ?></td>
                    <td><?= $value['nama_barang'] ?></td>
                    <td><?= $value['merek'] ?></td>
                    <td><?= $value['status'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>

    <!-- modal tambah -->
    <div class="modal" id="modal-tambah" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Barang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group">
                <label>Kode Barang</label>
                <div id="kdbarang"></div>
              </div>
              <div class="form-group">
                <label">Nama :</label>
                  <select style="width:100%" class="form-control select-barang" id="selectbarang" name="barang">
                    <option value="" selected disabled>Pilih Barang</option>
                  </select>
              </div>

              <div class="form-group">
                <label">Merk :</label>
                  <select style="width:100%" class="form-control select-merek" id="selectmerek" name="merek">
                    <option value="" selected disabled>Pilih Merek</option>
                  </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal tambah -->
    <?php include_once 'template/footer.php' ?>

  </div>
  </div>


  <script>
    $(document).ready(function() {
      $("#kdbarang").load("tmpbarang.php");
      setInterval(function() {
        $("#kdbarang").load("tmpbarang.php");
      }, 500);
    });
  </script>
  <script>
    $(document).ready(function() {
      $('.select-barang').select2({
        data: [
          <?php
          //koneksi ke database
          $query = $kon->kueri("SELECT * FROM tb_barang");
          //mengambil data dan menuliskan ke dalam format yang sesuai dengan Select2  
          foreach ($query as $row) {
            echo "{id: '" . $row['nama_barang'] . "', text: '" . $row['nama_barang'] . "'}, ";
          }
          ?>
        ],
        dropdownParent: $('#modal-tambah'),
        placeholder: 'Pilih Barang'
      }).on('change', function() {
        var selectedValue = $(this).val();
        if (selectedValue !== '') {
          console.log(selectedValue);
          $.ajax({
            url: 'get_merek.php', //ubah dengan file yang memuat query select dari tb_barang
            type: 'POST',
            dataType: 'json',
            data: {
              nama_barang: selectedValue
            },
            success: function(data) {
              $('.select-merek').empty();
              $('.select-merek').append('<option value="">Pilih Merek</option>');
              $.each(data, function(index, value) {
                $('.select-merek').append('<option value="' + value.id_barang + '">' + value.merek + '</option>');
              });
            }
          });
        }
      });

      $('.select-merek').select2({
        dropdownParent: $('#modal-tambah'),
        placeholder: 'Pilih Merek'
      });
    });
  </script>

</body>

</html>