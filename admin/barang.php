            <?php
            session_start();
            if (!isset($_SESSION['teknisi_id'])) {
                header("Location: login.php");
                exit();
            }
            include_once "koneksi.php";
            $kon = new Koneksi();
            $ab = $kon->kueri("SELECT * FROM tb_barang");
            // $data = $kon->hasil_data($ab);

            if(isset($_POST['delete'])){
                $id = $_POST['delete'];
                $dlt = $kon->kueri("DELETE FROM tb_barang WHERE id_barang = '$id' ");
            if ($dlt==true) {
                $_SESSION['hapus'] = "1";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
            }else {
                $_SESSION['hapus'] = "0";
                header("Location: ".$_SERVER['PHP_SELF']);
            exit();
            }
            }

            if(isset($_POST['tambah'])){
            $kdbarang = strip_tags($_POST['tkdbarang']);
            $namabarang = strip_tags($_POST['tnamabarang']);
            $merek = strip_tags($_POST['tmerek']);
            $kuantiti = strip_tags($_POST['tkuantiti']);
            $status = 1;
            $abc= $kon->kueri("INSERT INTO tb_barang (id_barang,kd_barang,nama_barang,merek,kuantiti,status) VALUES (NULL,'$kdbarang','$namabarang','$merek','$kuantiti','$status')");
            if ($abc==true) {
                $_SESSION['tambah'] = "1";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
            }else {
                $_SESSION['tambah'] = "0";
                header("Location: ".$_SERVER['PHP_SELF']);
            exit();
            }
            }


              if(isset($_POST['edit'])){
            $idbarang = strip_tags($_POST['tidbarang']);
            $kdbarang = strip_tags($_POST['tkdbarang']);
            $namabarang = strip_tags($_POST['tnamabarang']);
            $merek = strip_tags($_POST['tmerek']);
            $kuantiti = strip_tags($_POST['tkuantiti']);
            $status = 1;
            $abc= $kon->kueri("UPDATE tb_barang SET id_barang='$idbarang',kd_barang='$kdbarang',nama_barang='$namabarang',merek='$merek',kuantiti='$kuantiti',status='$status' WHERE id_barang ='$idbarang' ");
            if ($abc==true) {
                $_SESSION['edit'] = "1";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
            }else {
                $_SESSION['edit'] = "0";
                header("Location: ".$_SERVER['PHP_SELF']);
            exit();
            }
            }
            ?>


            <!DOCTYPE html>
            <html lang="en">

      <?php include_once "template/header.php"?>

            <body>
                <?php include_once "template/sidebar.php"?>
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
                                </div>
                                <div class="card-header">
                                    <?php
                                    if (isset($_SESSION['tambah'])) {
                                        if ($_SESSION['tambah']==1) {
                                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <strong>Data Berhasil Ditambahkan !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';

                                                    unset($_SESSION['tambah']);
                                
                                        }else if($_SESSION['tambah']==0) {
                                              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Gagal Ditambahkan !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                                    unset($_SESSION['tambah']);
                                                    
                                        }
                                    }

                                    if (isset($_SESSION['edit'])) {
                                        if ($_SESSION['edit']==1) {
                                             echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <strong>Data Berhasil Diedit !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                                    unset($_SESSION['edit']);
                                
                                        }else if($_SESSION['edit']==0) {
                                              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Gagal Diedit !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                                    unset($_SESSION['edit']);
                                                    
                                        }
                                    }

                                    if (isset($_SESSION['hapus'])) {
                                        if ($_SESSION['hapus']==1) {
                                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <strong>Data Berhasil Dihapus !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                                    unset($_SESSION['hapus']);
                                
                                        }else if($_SESSION['tambah']==0) {
                                              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Gagal Dihapus!
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
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Merek</th>
                                                <th>Kuantiti</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ab as $value) :?>
                                            <tr>
                                                <td><?= $value['kd_barang']?></td>
                                                <td><?= $value['nama_barang']?></td>
                                                <td><?= $value['merek']?></td>
                                                <td><?= $value['kuantiti']?></td>
                                                <td>
                                                    <?php echo '<button type="button" data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#modal-edit' . $value['id_barang'] . '"><i class="bi bi-pen"></i></button>'; ?>
                                                    <?php echo '<button type="button" data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#hapus' . $value['id_barang'] . '"><i class="bi bi-trash"></i></button>'; ?>
                                                </td>
                                            </tr>

                                            <!-- modal-hapus -->
                                            <?php  echo '<div class="modal fade" id="hapus' . $value['id_barang'] . '" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">';?>
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Data Barang</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center>
                                                            <h4>Apakah anda ingin hapus data</h4>
                                                            <h4>tersebut ?</h4>
                                                        </center>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form action="" method="POST">
                                                            <?php echo '<button type="submit" class="btn btn-primary" name="delete" value="' . $value['id_barang'] . ' " ">Hapus</button>'; ?>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                <!-- end-modal-hapus -->


                                <!-- modal-edit -->
                                            <?php  echo '<div class="modal" id="modal-edit' . $value['id_barang'] . '" tabindex="-1">';
                                            $idbarang= $value['id_barang'];
                                    
                                            $tampil = $kon->kueri("SELECT * FROM tb_barang WHERE id_barang = '$idbarang' ");
                                            $data = $kon->hasil_data($tampil);
                                            ?>
                            
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data Barang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                
                                        <label>Kode Barang</label>
                                        <input type="hidden" name="tidbarang"value="<?=$data['id_barang']?>">
                                        <input type="text" name="tkdbarang" class="form-control" value="<?=$data['kd_barang']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="tnamabarang" class="form-control"  value="<?=$data['nama_barang']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Merek</label>
                                        <input type="text" name="tmerek" class="form-control"  value="<?=$data['merek']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kuantiti</label>
                                        <input type="text" name="tkuantiti" class="form-control"  value="<?=$data['kuantiti']?>" required>
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


                                <?php endforeach;?>
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
                                        <label>Kode Barang</label>
                                        <input type="text" name="tkdbarang" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="tnamabarang" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Merek</label>
                                        <input type="text" name="tmerek" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kuantiti</label>
                                        <input type="text" name="tkuantiti" class="form-control" required>
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
              <?php include_once 'template/footer.php'?>


            </body>

            </html>