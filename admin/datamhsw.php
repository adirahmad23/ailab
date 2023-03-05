<?php
 session_start();
            if (!isset($_SESSION['teknisi_id'])) {
                header("Location: login.php");
                exit();
            }
            include_once 'koneksi.php';
            $kon = new Koneksi();


            if(isset($_POST['delete'])){
                $id = $_POST['delete'];
                $dlt = $kon->kueri("DELETE FROM tb_mahasiswa WHERE id_mahasiswa = '$id' ");
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

            // if(isset($_POST['tambah'])){
            // $kdbarang = strip_tags($_POST['tkdbarang']);
            // $namabarang = strip_tags($_POST['tnamabarang']);
            // $merek = strip_tags($_POST['tmerek']);
            // $kuantiti = strip_tags($_POST['tkuantiti']);
            // $status = 1;
            // $abc= $kon->kueri("INSERT INTO tb_barang (id_barang,kd_barang,nama_barang,merek,kuantiti,status) VALUES (NULL,'$kdbarang','$namabarang','$merek','$kuantiti','$status')");
            // if ($abc==true) {
            //     $_SESSION['tambah'] = "1";
            // header("Location: ".$_SERVER['PHP_SELF']);
            // exit();
            // }else {
            //     $_SESSION['tambah'] = "0";
            //     header("Location: ".$_SERVER['PHP_SELF']);
            // exit();
            // }
            // }


              if(isset($_POST['edit'])){
            $idmahasiswa = strip_tags($_POST['tidmahasiswa']);
            $idrfid = strip_tags($_POST['tidrfid']);
            $namamahasiswa = strip_tags($_POST['tnamamahasiswa']);
            $nrp = strip_tags($_POST['tnrp']);
            $kelas = strip_tags($_POST['tkelas']);
            $email = strip_tags($_POST['temail']);
            // $status = 1;
            $abc= $kon->kueri("UPDATE tb_mahasiswa SET id_mahasiswa='$idmahasiswa',id_rfid='$idrfid',nama_mahasiswa='$namamahasiswa',nrp='$nrp',kelas='$kelas',email='$email' WHERE id_mahasiswa ='$idmahasiswa' ");
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">
    
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/css/pages/simple-datatables.css">

</head>

<body>
    <?php include_once "sidebar.php"?>
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
                        <h3>Data Mahasiswa</h3>
                        <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Mahasiswa</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Data Mahasiswa
                    </div>
                    <div class="btn-tambah p-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah">Tambah Data Mahasiswa</button>
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
                                    <th>ID RFID</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NRP</th>
                                    <th>Kelas</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php 
                            $loop = $kon->kueri("SELECT * FROM tb_mahasiswa");
                            foreach ($loop as $value) :?>
                            <tbody>
                                <tr>
                                    <td><?=$value['id_rfid']?></td>
                                    <td><?=$value['nama_mahasiswa']?></td>
                                    <td><?=$value['nrp']?></td>
                                    <td><?=$value['kelas']?></td>
                                    <td><?=$value['email']?></td>
                                    <td>
                                    <?php echo '<button type="button" data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#modal-edit' . $value['id_mahasiswa'] . '"><i class="bi bi-pen"></i></button>'; ?>
                                    <?php echo '<button type="button" data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#hapus' . $value['id_mahasiswa'] . '"><i class="bi bi-trash"></i></button>'; ?>                                    </td>
                                </tr>
                            </tbody>

                             <!-- modal-hapus -->
                                            <?php  echo '<div class="modal fade" id="hapus' . $value['id_mahasiswa'] . '" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">';?>
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
                                                            <?php echo '<button type="submit" class="btn btn-primary" name="delete" value="' . $value['id_mahasiswa'] . ' " ">Hapus</button>'; ?>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                <!-- end-modal-hapus -->


                                <!-- modal-edit -->
                                            <?php  echo '<div class="modal" id="modal-edit' . $value['id_mahasiswa'] . '" tabindex="-1">';
                                            $idbarang= $value['id_mahasiswa'];
                                    
                                            $tampil = $kon->kueri("SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$idbarang' ");
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
                                                
                                        <label>ID RFID</label>
                                        <input type="hidden" name="tidmahasiswa"value="<?=$data['id_mahasiswa']?>">
                                        <input type="text" name="tidrfid" class="form-control" value="<?=$data['id_rfid']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Mahasiswa</label>
                                        <input type="text" name="tnamamahasiswa" class="form-control"  value="<?=$data['nama_mahasiswa']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>NRP</label>
                                        <input type="text" name="tnrp" class="form-control"  value="<?=$data['nrp']?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <input type="text" name="tkelas" class="form-control"  value="<?=$data['kelas']?>" required>
                                    </div>
                                      <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="temail" class="form-control"  value="<?=$data['email']?>" required>
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
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                        href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- modal-tambah -->
    <div class="modal" id="modal-tambah" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Mahasiswa</h5>
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
                <label>NRP</label>
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
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/app.js"></script>

<script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="assets/js/pages/simple-datatables.js"></script>

</body>

</html>
