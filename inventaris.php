<?php
session_start();
if (!isset($_SESSION["mahasiswa_id"])) {
  header("Location: login.php");
  exit;
}

include "proses/koneksi.php";
$kon = new Koneksi();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'admin/assets/email/vendor/autoload.php';


$nama = $_SESSION['nama'];
$idmhsw = $_SESSION['mahasiswa_id'];
$message = '';
if (isset($_POST["add_to_cart"])) {
  if (isset($_COOKIE["cart_barang"])) {
    $cookie_data = stripslashes($_COOKIE['cart_barang']);
    $cart_data = json_decode($cookie_data, true);
  } else {
    $cart_data = array();
  }

  $item_id_list = array_column($cart_data, 'id_barang');

  if (in_array($_POST["hidden_id"], $item_id_list)) {
    foreach ($cart_data as $keys => $values) {
      if ($cart_data[$keys]["id_barang"] == $_POST["hidden_id"]) {
        $cart_data[$keys]["kuantiti"] = $cart_data[$keys]["kuantiti"] + $_POST["kuantiti"];
        if ($cart_data[$keys]["kuantiti"] > $_POST["stok"]) {
          $cart_data[$keys]["kuantiti"] = $_POST["stok"];
          header("location:inventaris.php?stok_lebih=1");
          exit();
        }
      }
    }
  } else {
    $item_array = array(
      'id_barang'            =>    $_POST["hidden_id"],
      'nama_barang'          =>    $_POST["nama_barang"],
      'merek'                =>    $_POST["merek"],
      'kuantiti'             =>    $_POST["kuantiti"],
      'kdbarang'             =>    $_POST["kdbarang"],
      'stok'                 =>    $_POST["stok"]
    );
    $cart_data[] = $item_array;
    // var_dump($cart_data);
    // die;
  }


  $item_data = json_encode($cart_data);
  setcookie('cart_barang', $item_data, time() + (86400 * 30));
  header("location:inventaris.php?success=1");
  $total_item = $total_item + 1;
}

if (isset($_GET["action"])) {
  if ($_GET["action"] == "delete") {
    $cookie_data = stripslashes($_COOKIE['cart_barang']);
    $cart_data = json_decode($cookie_data, true);
    foreach ($cart_data as $keys => $values) {
      if ($cart_data[$keys]['id_barang'] == $_GET["id"]) {
        unset($cart_data[$keys]);
        $item_data = json_encode($cart_data);
        setcookie("cart_barang", $item_data, time() + (86400 * 30));
        header("location:inventaris.php?remove=1");
      }
    }
  }
  if ($_GET["action"] == "clear") {
    setcookie("cart_barang", "", time() - 3600);
    header("location:inventaris.php?clearall=1");
  }
}
if (isset($_GET["stok_lebih"])) {
  $message = '
	<div class="alert alert-warning alert-dismissible mb-0 mx-1 mb-1 flex-grow-1">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item Telah mencapai batas stok
	</div>
	';
}
if (isset($_GET["success"])) {
  $message = '
	<div class="alert alert-success alert-dismissible mb-0 mx-1 mb-1 flex-grow-1">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Item Telah Ditambahkan Dikeranjang
	</div>
	';
}


if (isset($_GET["remove"])) {
  $message = '
	<div class="alert alert-danger alert-dismissible mb-0 mx-4 mb-2 flex-grow-1">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Item Telah Dihapus Dari Keranjang
	</div>
	';
}
if (isset($_GET["clearall"])) {
  $message = '
	<div class="alert alert-primary alert-dismissible mb-0 mx-4 mb-2 flex-grow-1">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Keranjang Anda Kosong...
	</div>
	';
}
?>
<?php
if (isset($_POST['chekout'])) {
  $nama = $_SESSION['nama'];
  $idmhsw = $_SESSION['mahasiswa_id'];
  $id_barang = implode(",", $_POST['id_barang']);
  $nama_barang = implode(",", $_POST['nama_barang']);
  $merek = implode(",", $_POST['merek']);
  $kuantiti =  implode(",", $_POST['kuantiti']);
  $status = "0";
  $kdbarang = implode(",", $_POST['kd_barang']);
  $id_inventaris = implode(",", $_POST['id_inventaris']);
  $aray_idinventaris = explode(",", $id_inventaris);
  $aray_idbarang = explode(",", $id_barang);
  $aray_namabarang = explode(",", $nama_barang);
  $aray_merek = explode(",", $merek);
  $length = count($aray_idbarang);
  $kuantitis = explode(",", $kuantiti);
  $total = 0;
  // echo "Nama: " . $nama . "<br>";
  // echo "ID Mahasiswa: " . $idmhsw . "<br>";
  // echo "ID Barang: " . $id_barang . "<br>";
  // echo "Nama Barang: " . $nama_barang . "<br>";
  // echo "Merek: " . $merek . "<br>";
  // echo "Kuantiti: " . $kuantiti . "<br>";
  // echo "Status: " . $status . "<br>";
  // echo "Kode Barang: " . $kdbarang . "<br>";
  // echo "ID Inventaris: " . $id_inventaris . "<br>";
  // die;
  foreach ($kuantitis as $nilai) {
    $total += $nilai;
  }

  for ($i = 0; $i < $total; $i++) {
    $data_idinven = $aray_idinventaris[$i];
    $update_stok = $kon->kueri("UPDATE tb_inventaris SET status = '0' WHERE id_inventaris = '$data_idinven' ");
  }

  for ($i = 0; $i < $length; $i++) {
    $data_id = $aray_idbarang[$i];
    $data_nama = $aray_namabarang[$i];
    $data_merek = $aray_merek[$i];
    $count_data = $kon->kueri("SELECT id_barang, status, merek, nama_barang, COUNT(*) as total FROM tb_inventaris WHERE status = '0' AND id_barang = '$data_id' AND proses = '1' GROUP BY status, merek, nama_barang ");
    foreach ($count_data as $row) {
      $id_barang = $row['id_barang'];
      $status = $row['status'];
      $merek = $row['merek'];
      $nama_barang = $row['nama_barang'];
      $total = $row['total'];
      $update_stok = $kon->kueri("SELECT stok FROM tb_barang WHERE id_barang = '$id_barang'");
      $data = $kon->hasil_data($update_stok);
      $stok = $data['stok'];
      $kurang = $stok - $total;
      $update =  $kon->kueri("UPDATE tb_barang SET stok = '$kurang' WHERE id_barang = '$id_barang'");
    }
  }
  if ($kon->jumlah_data($count_data) > 0) {
    $loop = 0;
    foreach ($kuantitis as $angka) {
      $loop += $angka;
    }
    for ($i = 0; $i < $loop; $i++) {
      $data_idinven = $aray_idinventaris[$i];
      $update_proses = $kon->kueri("UPDATE tb_inventaris SET proses = '0' WHERE id_inventaris = '$data_idinven' ");
    }
  }

  $id_barang = implode(",", $_POST['id_barang']);
  $nama_barang = implode(",", $_POST['nama_barang']);
  $merek = implode(",", $_POST['merek']);
  $idmhswa = $_SESSION['mahasiswa_id'];
  $idrfid = $_SESSION['rfid'];
  if ($kon->kueri("INSERT INTO tb_chekout(id_chekout, id_barang,id_inventaris,kd_barang, id_mahasiswa, nama_mahasiswa, nama_barang, merek, kuantiti, status) VALUES (NULL,'$id_barang','$id_inventaris','$kdbarang','$idmhswa','$nama','$nama_barang','$merek','$kuantiti','$status')")) {
    $kon->kueri("INSERT INTO tb_peminjaman(id_mahasiswa,id_rfid,nama_mahasiswa, kd_barang, nama_barang, merek, kuantiti, status) VALUES ('$idmhsw','$idrfid','$nama','$kdbarang','$nama_barang','$merek','$kuantiti','0')");
    setcookie("cart_barang", "", time() - 3600);

    $datamail = $kon->kueri("SELECT * FROM tb_teknisi WHERE id_teknisi = '1' ");
    $datamael = $kon->hasil_data($datamail);
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'ailab.cyberpink.my.id';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ailab@ailab.cyberpink.my.id';
    $mail->Password   = 'ailab2023lulus';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->SMTPDebug = 0; // Nonaktifkan log
    $mail->setFrom('ailab@ailab.cyberpink.my.id', 'Ailab');
    $mail->addAddress($datamael['email'], 'Kepala LAB');
    $mail->isHTML(true);

    $mail->Subject = 'Notifikasi Persetujuan Peminjaman Barang';
    $mail->Body    =  "Anda Memiliki Notifikasi Persetujuan Peminjaman Barang Dari Mahasiswa,  $nama dengan, <br> Nama barang : $nama_barang <br> Spesifikasi barang : $merek. <br> <br> Mohon untuk segera menyetujui peminjaman barang tersebut. <br><br> <a href='https://ailab.cyberpink.my.id/admin/persetujuan.php' class='btn btn-primary'>Masuk Ke Persetujuan</a> <br> <br> Terimakasih.";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
      echo '<script>alert("Pesan Gagal Terkirim / Periksa Jaringan");</script>';
    }



    header("location:inventaris.php?clearall=1");
    $_SESSION['chekout'] = "1";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  } else {
    $_SESSION['chekout'] = "0";
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
  <title>Inventaris Barang</title>

  <link rel="stylesheet" href="assets/css/main/app.css">
  <link rel="stylesheet" href="assets/css/main/app-dark.css">
  <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon">
  <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

  <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
  <link rel="stylesheet" href="assets/css/pages/simple-datatables.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
  <?php include_once "sidebar.php" ?>
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

            <div class="cart d-flex align-items-center">
              <button type="button" class="btn btn-primary mx-4 " data-bs-toggle="modal" data-bs-target="#cart"><i class="bi bi-cart3"></i></button>
              <?= $message ?>
              <?php
              if (isset($_SESSION['chekout'])) {
                if ($_SESSION['chekout'] == 1) {
                  echo '<div class="alert alert-success alert-dismissible mb-0 mx-1 mb-1 flex-grow-1">
                                                        <strong>Barang Berhasil Dichekout !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';

                  unset($_SESSION['chekout']);
                } else if ($_SESSION['chekout'] == 0) {
                  echo '<div class="alert alert-warning alert-dismissible mb-0 mx-1 mb-1 flex-grow-1">
                                                        <strong>Barang Gagal Dichekout!
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                  unset($_SESSION['chekout']);
                }
              }
              ?>
            </div>
          </div>

          <style>
            .cart {
              display: flex;
              align-items: left;
            }

            .alert {
              margin-left: 10px;
            }
          </style>


          <?php
          $result = $kon->kueri("SELECT DISTINCT tb_barang.id_barang, tb_barang.nama_barang, tb_barang.merek, tb_barang.stok, tb_inventaris.kd_barang 
          FROM tb_barang 
          LEFT JOIN tb_inventaris ON tb_barang.id_barang = tb_inventaris.id_barang 
          GROUP BY tb_barang.id_barang, tb_barang.nama_barang, tb_barang.merek, tb_barang.stok
          ORDER BY tb_barang.nama_barang ASC;
          ;
                                ");
          ?>
          <div class="card-body">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Nama Barang</th>
                  <th>Spesifikasi</th>
                  <th>Jumlah Stock</th>
                  <th width="23%">
                    <center>Aksi</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $minim = $kon->kueri("SELECT * FROM tb_peminjaman WHERE nama_mahasiswa = '$nama' AND id_mahasiswa = '$idmhsw' AND (status = '0' OR status = '1' OR status = '2') ");
                $data = $kon->hasil_data($minim);
                if ($data > 0) { ?>
                  <tr>
                    <td colspan=" 6" class="text-center">Anda Sudah Meminjam Barang</td>
                  </tr>
                <?php } else { ?>
                  <?php foreach ($result as $index => $row) { ?>
                    <tr>
                      <td><?= $index + 1 ?></td>
                      <td><?= $row["nama_barang"] ?></td>
                      <td><?= $row["merek"] ?></td>
                      <td><?= $row["stok"] ?></td>
                      <td>
                        <form action="" method="post">
                          <div class="col-md-12">
                            <div class="input-group">
                              <?php if ($row["stok"] > 0) : ?>
                                <button class="btn btn-outline-primary minus-btn" type="button">-</button>
                                <input type="text" name="kuantiti" class="form-control text-center quantity-input md-1 form-control-sm" value="1" min="1" max="<?= $row["stok"] ?>" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <button class="btn btn-outline-primary plus-btn" type="button">+</button>
                              <?php endif; ?>

                              <?php if ($row["stok"] == 0) : ?>

                                <input type="submit" style="width:100%;" class="btn btn-primary" value="Kosong" disabled />

                              <?php else : ?>
                                <div class="input-group-append" style="margin-left: 10px;">
                                  <input type="submit" name="add_to_cart" class="btn btn-primary" value="Checkout" />
                                </div>
                                <input type="hidden" name="nama_barang" value="<?= $row["nama_barang"]; ?>" />
                                <input type="hidden" name="merek" value="<?= $row["merek"]; ?>" />
                                <input type="hidden" name="stok" value="<?= $row["stok"]; ?>" />
                                <input type="hidden" name="hidden_id" value="<?= $row["id_barang"]; ?>" />
                                <input type="hidden" name="kdbarang" value="<?= $row["kd_barang"]; ?>" />
                              <?php endif; ?>

                            </div>
                          </div>

                        </form>

                      </td>

                    </tr>
                  <?php } ?>
                <?php } ?>
              </tbody>

            </table>
          </div>
        </div>
      </section>
    </div>

    <!-- modal -->
    <div class="modal" id="cart" tabindex="-1">
      <div class="modal-dialog modal-dialog modal-xl">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">List Data Peminjaman</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <div align="right">
                <a href="inventaris.php?action=clear"><b>Clear Cart</b></a>
              </div>
              <table class="table table-bordered">
                <tr>
                  <th width="30%">Nama Barang</th>
                  <th width="20%">Spesifikasi</th>
                  <th width="5%">Stok</th>
                  <th width="14%">Kuantiti</th>
                  <th width="10%">Aksi</th>
                </tr>
                <?php
                $array = array();
                if (isset($_COOKIE["cart_barang"])) {
                  $total = 0;
                  $cookie_data = stripslashes($_COOKIE['cart_barang']);
                  $cart_data = json_decode($cookie_data, true);
                  foreach ($cart_data as $keys => $values) {
                    $array[] = $values["kuantiti"];


                ?>
                    <tr>

                      <td><?php echo $values["nama_barang"]; ?></td>
                      <td><?php echo $values["merek"]; ?></td>
                      <td><?php echo $values["stok"]; ?></td>
                      <td>
                        <form action="" method="post">
                          <?php echo $values["kuantiti"]; ?>
                          <input type="hidden" name="kuantiti[]" class="form-control text-center quantity-input" value="<?= $values['kuantiti'] ?>">
                      </td>

                      <td><a href=" inventaris.php?action=delete&id=<?php echo $values["id_barang"]; ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></span></a>
                      </td>
                    </tr>
                  <?php
                    // $total = $total + ($values["kuantiti"] * $values["merek"]);

                  }
                  ?>
                  <?php

                  foreach ($cart_data as $keys => $values) {
                    $array[] = $values["id_barang"];
                    $array[] = $values["nama_barang"];
                    $array[] = $values["merek"];
                    $array[] = $values["kdbarang"];
                    $array[] = $values["kuantiti"];

                    // buatkan input hidden untuk setiap data yang akan diinputkan ke database beri nama array[] agar bisa diinputkan ke database berikan , untuk memisahkan data
                  ?>

                    <input type="hidden" name="id_barang[]" value="<?php echo $values["id_barang"]; ?>">
                    <input type="hidden" name="nama_barang[]" value="<?php echo $values["nama_barang"]; ?>">
                    <input type="hidden" name="merek[]" value="<?php echo $values["merek"]; ?>">

                    <?php
                    $kd = $kon->kueri("SELECT kd_barang FROM tb_inventaris WHERE id_barang = '" . $values["id_barang"] . "' AND status = '1' ");
                    $array_kd = $kon->hasil_array($kd);

                    $id = $kon->kueri("SELECT id_inventaris FROM tb_inventaris WHERE id_barang = '" . $values["id_barang"] . "' AND status = '1' ");
                    $array_id = $kon->hasil_array($id);

                    for ($i = 0; $i < $values['kuantiti']; $i++) {
                      $arraykd = $array_kd[$i];
                      $araryinputkd = implode($arraykd);
                    ?>
                      <input type="hidden" name="kd_barang[]" value="<?php echo $araryinputkd; ?>">

                <?php
                    }
                    for ($i = 0; $i < $values['kuantiti']; $i++) {
                      $arrayid = $array_id[$i];
                      $araryinputid = implode($arrayid);
                      echo "<input type='hidden' name='id_inventaris[]' value='$araryinputid'>";
                    }
                  }
                } else {
                  echo '
                                    <tr>
                                        <td colspan="5" align="center">Tidak Ada Barang</td>
                                    </tr>
                                    ';
                }
                ?>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="chekout" class="btn btn-primary">Chekout Barang</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php include_once 'footer.php' ?>

  </div>
  </div>

  <script>
    // Menangani perubahan nilai pada input spinner
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
      input.addEventListener('change', function() {
        const maxValue = parseInt(this.getAttribute('max'));
        const minValue = parseInt(this.getAttribute('min'));
        let value = parseInt(this.value);
        if (isNaN(value)) {
          value = 1;
        } else if (value > maxValue) {
          value = maxValue;
        } else if (value < minValue) {
          value = minValue;
        }
        this.value = value;
      });
    });

    // Menangani tombol plus dan minus pada input spinner
    const minusButtons = document.querySelectorAll('.minus-btn');
    const plusButtons = document.querySelectorAll('.plus-btn');
    minusButtons.forEach(button => {
      button.addEventListener('click', function() {
        const input = this.nextElementSibling;
        const minValue = parseInt(input.getAttribute('min'));
        let value = parseInt(input.value);
        if (isNaN(value) || value <= minValue) {
          value = minValue;
        } else {
          value--;
        }
        input.value = value;
      });
    });
    plusButtons.forEach(button => {
      button.addEventListener('click', function() {
        const input = this.previousElementSibling;
        const maxValue = parseInt(input.getAttribute('max'));
        let value = parseInt(input.value);
        if (isNaN(value) || value >= maxValue) {
          value = maxValue;
        } else {
          value++;
        }
        input.value = value;


      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Mendaftarkan event listener pada tombol dengan class "plus-btn"
      $(".plus-btn").on("click", function() {
        // Mengambil nilai kuantiti dari input dengan name "kuantiti"
        var kuantiti = $("input[name='kuantiti']").val();

        // Mengirim data ke server melalui AJAX
        $.ajax({
          url: "inventaris.php",
          type: "POST",
          data: {
            kuantiti: kuantiti
          },
          success: function(response) {
            // Memperbarui tampilan halaman web
            var kuantitiElem = $(".kuantiti");
            var kuantitiValue = parseInt(kuantitiElem.text()) + parseInt(kuantiti);
            kuantitiElem.text(kuantitiValue);
          }
        });
      });
    });
  </script>

  <!-- <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/app.js"></script> -->

  <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
  <script src="assets/js/pages/simple-datatables.js"></script>

</body>

</html>