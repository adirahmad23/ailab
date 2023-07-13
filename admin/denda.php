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
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Denda Pembayaran</th>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>yayaya</td>
                                    <td>yayaya</td>
                                    <td>yayaya</td>
                                    <td>yayaya</td>
                                    <td>
                                        <form action="" method="POST" id="aksi">
                                            <input type="hidden" name="id" value="">
                                            <button type="submit" class="btn btn-success" name="sukses"><i class="bi bi-check-circle"></i></button>
                                            <button type="submit" class="btn btn-danger" name="tolak"><i class="bi bi-x-circle"></i></button>
                                        </form>
                                    </td>
                                </tr>


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