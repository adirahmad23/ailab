<?php
session_start();
if (!isset($_SESSION["teknisi_id"])) {
    header("Location: login.php");
    exit;
}
include "../proses/koneksi.php";
$kon = new Koneksi();
$nama =  $_SESSION['nama_teknisi'];
$idteknisi = $_SESSION['teknisi_id'];
$abc = $kon->kueri("SELECT * FROM tb_teknisi WHERE id_teknisi = '$idteknisi' ");
$data = $kon->hasil_data($abc);




if (isset($_POST['edit-profil'])) {
    $idteknisi = $_SESSION['teknisi_id'];
    $namateknisi = strip_tags($_POST['tnama']);
    $email = strip_tags($_POST['temail']);

    $emailcek = $kon->kueri("SELECT nama_teknisi,email FROM tb_teknisi where id_teknisi = '$idteknisi' ");
    $datanama = $kon->hasil_data($emailcek);
    if ($email != $datanama['email']) {
        $abc = $kon->kueri("UPDATE tb_teknisi SET nama_teknisi='$namateknisi', email='$email' WHERE id_teknisi ='$idteknisi' ");
        if ($abc == true) {
            $_SESSION['edit-profil'] = "1";
        } else {
            $_SESSION['edit-profil'] = "0";
        }
    } else if ($namateknisi != $datanama['nama_teknisi']) {
        $abc = $kon->kueri("UPDATE tb_teknisi SET nama_teknisi='$namateknisi', email='$email' WHERE id_teknisi ='$idteknisi' ");
        if ($abc == true) {
            $_SESSION['edit-profil'] = "1";
        } else {
            $_SESSION['edit-profil'] = "0";
        }
    } else {
        $_SESSION['edit-profil'] = "2";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


if (isset($_POST['edit-pass'])) {
    $idteknisi = $_SESSION['teknisi_id'];
    $passlama =  md5(strip_tags($_POST['tpasslama']));
    $passbaru = md5(strip_tags($_POST['tpassbaru']));
    $konfirmasipass = md5(strip_tags($_POST['tkonfirmasipass']));

    $abc = $kon->kueri("SELECT * FROM tb_teknisi WHERE id_teknisi = '$idteknisi' ");
    $data = $kon->hasil_data($abc);
    $pass = $data['pass'];
    if ($passlama == $pass) {
        if ($passbaru == $konfirmasipass) {
            $abc = $kon->kueri("UPDATE tb_teknisi SET pass='$passbaru' WHERE id_teknisi ='$idteknisi' ");
            if ($abc == true) {
                $_SESSION['edit-pass'] = "1";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                $_SESSION['edit-pass'] = "0";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            $_SESSION['edit-pass'] = "2";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    } else {
        $_SESSION['edit-pass'] = "3";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/shared/iconly.css">
</head>


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
                        <h3>Profil Pengguna</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profil Pengguna</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <img src="assets/images/faces/5.webp" width="100px" alt="Profile" class="rounded-circle">
                                <br>
                                <h3><?= $data['nama_teknisi'] ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#detail">Overview</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#edit">Edit
                                            Profil</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ubah-password">Ubah Password</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane fade show active profile-overview" id="detail">
                                        <form>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="fullName" type="text" class="form-control" id="fullName" value="<?= $data['nama_teknisi'] ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Jabatan
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="fullName" type="text" class="form-control" id="fullName" value="<?php if ($data['status'] == '1') {
                                                                                                                                        echo 'Teknisi';
                                                                                                                                    } else if ($data['status'] == '0') {
                                                                                                                                        echo "Kepala Lab";
                                                                                                                                    }  ?>" readonly>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="tab-pane fade profile-edit pt-3" id="edit">
                                        <?php
                                        if (isset($_SESSION['edit-profil'])) {
                                            if ($_SESSION['edit-profil'] == 2) {
                                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Gagal mengubah profil (Nama Sudah Terdaftar)
                                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';

                                                unset($_SESSION['edit-profil']);
                                            }
                                        }
                                        ?>
                                        <!-- Profile Edit Form -->
                                        <form method="POST">
                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama
                                                    Mahasiswa</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="tnama" type="text" class="form-control" id="fullName" value="<?= $data['nama_teknisi'] ?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="temail" type="text" class="form-control" id="fullName" value="<?= $data['email'] ?>">
                                                </div>
                                            </div>


                                            <div class="text-center">
                                                <input type="submit" name="edit-profil" class="btn btn-primary" value="Simpan Perubahan">
                                            </div>
                                        </form><!-- End Profile Edit Form -->
                                    </div>

                                    <div class="tab-pane fade pt-3" id="ubah-password">
                                        <!-- Change Password Form -->
                                        <form method="POST">
                                            <div class="row mb-3">
                                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="tpasslama" type="password" class="form-control" id="currentPassword" placeholder="Masukan Password Lama" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="tpassbaru" type="password" class="form-control" id="newPassword" placeholder="Masukan Password Baru" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password
                                                    Baru</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="tkonfirmasipass" type="password" class="form-control" id="renewPassword" placeholder="Konfirmasi Password Baru" required>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <input type="submit" name="edit-pass" class="btn btn-primary" value="Simpan Perubahan">
                                            </div>
                                        </form><!-- End Change Password Form -->
                                    </div>
                                    <br>
                                    <?php

                                    if (isset($_SESSION['edit-pass'])) {
                                        if ($_SESSION['edit-pass'] == 1) {
                                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Password Berhasil Diganti !
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                                            unset($_SESSION['edit-pass']);
                                        } else if ($_SESSION['edit-pass'] == 0) {
                                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Password Gagal Diganti !
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                                            unset($_SESSION['edit-pass']);
                                        } else if ($_SESSION['edit-pass'] == 2) {
                                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Password Yang Anda Masukan Tidak Sesuai !
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                                            unset($_SESSION['edit-pass']);
                                        } else if ($_SESSION['edit-pass'] == 3) {
                                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Password Lama Yang Anda Masukan Tidak Sesuai !
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                                            unset($_SESSION['edit-pass']);
                                        }
                                    }

                                    ?>
                                </div><!-- End Bordered Tabs -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php include_once 'template/footer.php' ?>

</body>

</html>