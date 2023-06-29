<?php
session_start();
if (!isset($_SESSION['teknisi_id'])) {
  header("Location: login.php");
  exit();
}
include_once "../proses/koneksi.php";
$kon = new Koneksi();
$tampil = $kon->kueri("SELECT * FROM tb_inventaris");
$count = $kon->kueri("SELECT * FROM tb_inventaris");

//------------------tambah inventaris------------------
if (isset($_POST['tambah'])) {
  $kd_barang = strip_tags($_POST['tkdbarang']);
  $tbarang = strip_tags($_POST['tnamabarang']);
  $id_barang = strip_tags($_POST['tmerek']);
  $status = "1";

  $cek_data = $kon->kueri("SELECT * FROM tb_inventaris WHERE kd_barang = '$kd_barang' ");
  $jumlah = $kon->jumlah_data($cek_data);
  // echo $jumlah;
  if ($jumlah > 0) {
    $_SESSION['kdbarang'] = $kd_barang;
    $_SESSION['tambah-inventaris'] = "2";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }

  $tampil = $kon->kueri("SELECT * FROM tb_barang WHERE nama_barang = '$tbarang' AND id_barang = '$id_barang'");
  $data = $kon->hasil_data($tampil);

  $id_barang = $data['id_barang'];
  $nama_barang = $data['nama_barang'];
  $merek = $data['merek'];
  $tambah = $kon->kueri("INSERT INTO tb_inventaris VALUES( NULL,'$id_barang','$kd_barang','$nama_barang','$merek','$status','1')");

  $count_data = $kon->kueri("SELECT status, merek, nama_barang, COUNT(*) as total FROM tb_inventaris GROUP BY status, merek, nama_barang");
  while ($row = $kon->hasil_data($count_data)) {
    $status = $row['status'];
    $merek = $row['merek'];
    $nama_barang = $row['nama_barang'];
    $total = $row['total'];
    //buatkan saya update ke tabel tb_barang hasil count masukan kedalam field stok tanpa marus membuka halaman ini lagi
    $update =  $kon->kueri("UPDATE tb_barang SET stok = '$total' WHERE status = '$status' AND merek = '$merek' AND nama_barang = '$nama_barang'");
  }


  if ($tambah == true) {
    $_SESSION['tambah-inventaris'] = "1";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  } else {
    $_SESSION['tambah-inventaris'] = "0";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}
//-----------------------hapus inventaris-----------------------
if (isset($_POST['delete'])) {
  $id = $_POST['delete'];
  $hapus = $kon->kueri("DELETE FROM tb_inventaris WHERE id_inventaris = '$id'");
  if ($hapus == true) {
    $_SESSION['hapus-inventaris'] = "1";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  } else {
    $_SESSION['hapus-inventaris'] = "0";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}

//buatkan saya count dari masing masing status, merek dan nama barang pada tb_inventaris


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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah">Tambah
                            Inventaris</button>
                    </div>
                    <div class="card-header">
                        <?php
            //tambah
            if (isset($_SESSION['tambah-inventaris'])) {
              if ($_SESSION['tambah-inventaris'] == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <strong>Data Inventaris Berhasil Ditambahkan !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';

                unset($_SESSION['tambah-inventaris']);
              } else if ($_SESSION['tambah-inventaris'] == 0) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Inventaris Gagal Ditambahkan !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                unset($_SESSION['tambah-inventaris']);
              } else if ($_SESSION['tambah-inventaris'] == 2) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>Kode Barang "' . $_SESSION['kdbarang'] . '" Sudah Ada, Data Inventaris Gagal Ditambahkan!
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';

                unset($_SESSION['tambah-inventaris']);
                unset($_SESSION['kdbarang']);
              }
            }
            //hapus 
            if (isset($_SESSION['hapus-inventaris'])) {
              if ($_SESSION['hapus-inventaris'] == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <strong>Data Inventaris Berhasil Dihapus !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';

                unset($_SESSION['hapus-inventaris']);
              } else if ($_SESSION['hapus-inventaris'] == 0) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Inventaris Gagal Dihapus !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                unset($_SESSION['hapus-inventaris']);
              }
            }

            ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Spesifikasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no = 1;
                foreach ($tampil as $value) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $value['kd_barang'] ?></td>
                                    <td><?= $value['nama_barang'] ?></td>
                                    <td><?= $value['merek'] ?></td>
                                    <td>
                                        <?php
                      if ($value['status'] == 1) {
                        echo '<span class="badge bg-success">Tersedia</span>';
                      } else if ($value['status'] == 2) {
                        echo '<span class="badge bg-warning">Terboking</span>';
                      } elseif ($value['status'] == 0) {
                        echo '<span class="badge bg-secondary">Terpinjam</span>';
                      }
                      ?>
                                    </td>
                                    <td>
                                        <?php echo '<button type="button" data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#hapus' . $value['id_inventaris'] . '"><i class="bi bi-trash"></i></button>'; ?>
                                        <!-- modal-hapus -->
                                        <?php echo '<div class="modal fade" id="hapus' . $value['id_inventaris'] . '" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">'; ?>
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
                                                        <?php echo '<button type="submit" class="btn btn-primary" name="delete" value="' . $value['id_inventaris'] . ' " ">Hapus</button>'; ?>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                    </div>
                    <!-- end-modal-hapus -->
                    </td>
                    </tr>
                    <?php $no++;

                endforeach; ?>
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
                            <label">Nama Barang :</label>
                                <select style="width:100%" class="form-control select-barang" id="selectbarang"
                                    name="tnamabarang" required>
                                    <option value="" selected disabled>Pilih Barang</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label">Spesifikasi :</label>
                                <select style="width:100%" class="form-control select-merek" id="selectmerek"
                                    name="tmerek" required>
                                    <option value="" selected disabled>Pilih Spesifikasi</option>
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
    $('.select-barang').on('select2:unselect', function() {
        $('.select-merek').val('').trigger('change.select2');
    });

    $('.select-merek').select2({
        dropdownParent: $('#modal-tambah'),
        placeholder: 'Pilih Merek'
    }).prop('disabled', true);

    $('.select-barang').select2({
        data: [
            <?php
        //koneksi ke database
        $query = $kon->kueri("SELECT DISTINCT nama_barang FROM tb_barang");
        //mengambil data dan menuliskan ke dalam format yang sesuai dengan Select2  
        foreach ($query as $row) {
          echo "{id: '" . $row['nama_barang'] . "', text: '" . $row['nama_barang'] . "'}, ";
        }
        ?>
        ],
        dropdownParent: $('#modal-tambah'),
        placeholder: 'Pilih Barang'
    }).on('select2:select', function() {
        var selectedValue = $(this).val();
        if (selectedValue !== '') {
            $.ajax({
                url: 'get_merek.php', //ubah dengan file yang memuat query select dari tb_barang
                type: 'POST',
                dataType: 'json',
                data: {
                    nama_barang: selectedValue
                },
                success: function(data) {
                    $('.select-merek').empty();
                    $('.select-merek').append('<option value="">Pilih Spesifikasi</option>');
                    if (data.length > 0) {
                        $.each(data, function(index, value) {
                            $('.select-merek').append('<option value="' + value.id_barang +
                                '">' + value.merek + '</option>');
                        });
                        $('.select-merek').prop('disabled', false);
                    } else {
                        $('.select-merek').prop('disabled', true);
                    }
                }
            });
        } else {
            $('.select-merek').empty();
            $('.select-merek').append('<option value="">Pilih Barang dahulu</option>');
            $('.select-merek').prop('disabled', true);
        }
    });
    </script>

</body>

</html>