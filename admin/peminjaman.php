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
            <h3>Peminjaman Barang</h3>
            <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables</p>
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
          <div class="btn-tambah p-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah">Tambah Data Peminjaman</button>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Peminjam</th>
                  <th>Nama Barang</th>
                  <th>Tgl Pinjam</th>
                  <th>Tgl Kembali</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Graiden</td>
                  <td>vehicula.aliquet@semconsequat.co.uk</td>
                  <td>076 4820 8838</td>
                  <td>Offenburg</td>
                  <td>Offenburg</td>
                  <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit"><i class="bi bi-pen"></i></button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-hapus"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Dale</td>
                  <td>fringilla.euismod.enim@quam.ca</td>
                  <td>0500 527693</td>
                  <td>New Quay</td>
                  <td>Offenburg</td>
                  <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit"><i class="bi bi-pen"></i></button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-hapus"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Nathaniel</td>
                  <td>mi.Duis@diam.edu</td>
                  <td>(012165) 76278</td>
                  <td>Grumo Appula</td>
                  <td>Offenburg</td>
                  <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit"><i class="bi bi-pen"></i></button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-hapus"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Darius</td>
                  <td>velit@nec.com</td>
                  <td>0309 690 7871</td>
                  <td>Ways</td>
                  <td>Offenburg</td>
                  <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit"><i class="bi bi-pen"></i></button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-hapus"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
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
            <h5 class="modal-title">Tambah Data Pinjaman</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>ID Barang</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Peminjam</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Tgl Pinjam</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Tgl Kembali</label>
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
            <h5 class="modal-title">Edit Data Pinjaman</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>ID Barang</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Peminjam</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Tgl Pinjam</label>
              <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
              <label>Tgl Kembali</label>
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
            <h5 class="modal-title">Hapus Data Barang</h5>
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