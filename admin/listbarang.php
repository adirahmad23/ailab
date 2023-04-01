          <?php
            session_start();
            if (!isset($_SESSION['teknisi_id'])) {
                header("Location: login.php");
                exit();
            }
            include_once "../proses/koneksi.php";
            $kon = new Koneksi();
            $ab = $kon->kueri("SELECT * FROM tb_barang");

            //----------------------Hapus------------------------------------------------------
            if (isset($_POST['delete'])) {
                $id = $_POST['delete'];
                $dlt = $kon->kueri("DELETE FROM tb_barang WHERE id_barang = '$id' ");
                if ($dlt == true) {
                    $_SESSION['hapus'] = "1";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    $_SESSION['hapus'] = "0";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            }
            //----------------Tambah------------------------------------------------------------------
            if (isset($_POST['tambah'])) {
                $namabarang = strip_tags($_POST['tnamabarang']);
                $merek = strip_tags($_POST['tmerek']);
                $stok = 0;
                $status = 1;
                $kdbarang = strip_tags($_POST['nama_barang']);

                $cek_data = $kon->kueri("SELECT * FROM tb_barang WHERE merek = '$merek' ");
                $jumlah = $kon->jumlah_data($cek_data);
                // echo $jumlah;
                if ($jumlah > 0) {
                    $_SESSION['nama_barang'] = $namabarang;
                    $_SESSION['merek'] = $merek;
                    $_SESSION['tambah'] = "2";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }

                $abc = $kon->kueri("INSERT INTO tb_barang (id_barang,nama_barang,merek,stok,status) VALUES (NULL,'$namabarang','$merek','$stok','$status')");
                if ($abc == true) {
                    $_SESSION['tambah'] = "1";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    $_SESSION['tambah'] = "0";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            }

            //----------------Edit------------------------------------------------------------------

            if (isset($_POST['edit'])) {
                $idbarang = strip_tags($_POST['tidbarang']);
                $namabarang = strip_tags($_POST['tnamabarang']);
                $merek = strip_tags($_POST['tmerek']);
                $abc = $kon->kueri("UPDATE tb_barang SET nama_barang='$namabarang',merek='$merek' WHERE id_barang ='$idbarang' ");
                if ($abc == true) {
                    $_SESSION['edit'] = "1";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    $_SESSION['edit'] = "0";
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
                                  <h3>List Barang</h3>
                                  <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies
                                      thanks to simple-datatables</p>
                              </div>
                              <div class="col-12 col-md-6 order-md-2 order-first">
                                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                      <ol class="breadcrumb">
                                          <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                          <li class="breadcrumb-item active" aria-current="page">List Barang</li>
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
                                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah">Tambah
                                      Data Barang</button>
                                  <a href="update_stok.php" class="btn btn-primary">Refresh Stok</a>
                              </div>
                              <div class="card-header">
                                  <?php
                                    if (isset($_SESSION['tambah'])) {
                                        if ($_SESSION['tambah'] == 1) {
                                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <strong>Data Barang Berhasil Ditambahkan !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';

                                            unset($_SESSION['tambah']);
                                        } else if ($_SESSION['tambah'] == 0) {
                                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Barang Gagal Ditambahkan !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                            unset($_SESSION['tambah']);
                                        } else if ($_SESSION['tambah'] == 2) {
                                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>Merek  "' . $_SESSION['merek'] . '" Sudah Ada, Data Barang "' . $_SESSION['nama_barang'] . '" Gagal Ditambahkan!
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';

                                            unset($_SESSION['tambah']);
                                            unset($_SESSION['nama_barang']);
                                            unset($_SESSION['merek']);
                                        }
                                    }

                                    if (isset($_SESSION['edit'])) {
                                        if ($_SESSION['edit'] == 1) {
                                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <strong>Data Barang Berhasil Diedit !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                            unset($_SESSION['edit']);
                                        } else if ($_SESSION['edit'] == 0) {
                                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Barang Gagal Diedit !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                            unset($_SESSION['edit']);
                                        }
                                    }

                                    if (isset($_SESSION['hapus'])) {
                                        if ($_SESSION['hapus'] == 1) {
                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <strong>Data Barang Berhasil Dihapus !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                            unset($_SESSION['hapus']);
                                        } else if ($_SESSION['hapus'] == 0) {
                                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Barang Gagal Dihapus!
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                            unset($_SESSION['hapus']);
                                        }
                                    }
                                    ?>
                              </div>
                              <div class="card-body">
                                  <table class="table table-striped" id="table1">
                                      <thead>
                                          <tr>
                                              <th width="5%">No</th>
                                              <th>Nama Barang</th>
                                              <th>Merek</th>
                                              <th>Jumlah Stok</th>
                                              <th>Aksi</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1;
                                            foreach ($ab as $value) : ?>
                                              <tr>
                                                  <td><?= $no ?></td>
                                                  <td><?= $value['nama_barang'] ?></td>
                                                  <td><?= $value['merek'] ?></td>
                                                  <td><?= $value['stok'] ?></td>
                                                  <td>
                                                      <?php echo '<button type="button" data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#modal-edit' . $value['id_barang'] . '"><i class="bi bi-pen"></i></button>'; ?>
                                                      <?php echo '<button type="button" data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#hapus' . $value['id_barang'] . '"><i class="bi bi-trash"></i></button>'; ?>
                                                  </td>
                                              </tr>

                                              <!-- modal-hapus -->
                                              <?php echo '<div class="modal fade" id="hapus' . $value['id_barang'] . '" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">'; ?>
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
                                                          <form action="" method="POST">
                                                              <?php echo '<button type="submit" class="btn btn-primary" name="delete" value="' . $value['id_barang'] . ' " ">Hapus</button>'; ?>

                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                              </div>
                              <!-- end-modal-hapus -->


                              <!-- modal-edit -->
                              <?php echo '<div class="modal" id="modal-edit' . $value['id_barang'] . '" tabindex="-1">';
                                                $idbarang = $value['id_barang'];
                                                $tampil = $kon->kueri("SELECT * FROM tb_barang WHERE id_barang = '$idbarang' ");
                                                $data = $kon->hasil_data($tampil);
                                ?>

                              <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Edit Data Barang</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="POST">
                                          <input type="hidden" name="tidbarang" value="<?= $data['id_barang'] ?>">
                                          <div class="modal-body">
                                              <div class="form-group">
                                                  <label>Nama Barang</label>
                                                  <input type="text" name="tnamabarang" class="form-control" value="<?= $data['nama_barang'] ?>" required>
                                              </div>
                                              <div class="form-group">
                                                  <label>Merek</label>
                                                  <input type="text" name="tmerek" class="form-control" value="<?= $data['merek'] ?>" required>
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                          <!-- end-modal-edit -->
                      <?php $no++;
                                            endforeach; ?>
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
                              <h5 class="modal-title">Tambah Data Barang</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form action="" method="post">
                                  <div class="form-group">
                                      <label>Nama Barang</label>
                                      <input type="text" name="tnamabarang" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                      <label>Merek</label>
                                      <input type="text" name="tmerek" class="form-control" required>
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
              <?php include_once 'template/footer.php' ?>
              <script>
                  $(document).ready(function() {
                      $("#kdbarang").load("tmpbarang.php");
                      setInterval(function() {
                          $("#kdbarang").load("tmpbarang.php");
                      }, 500);
                  });
              </script>
          </body>

          </html>