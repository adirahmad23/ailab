<?php

//barang.php

include "koneksi.php";
$kon = new Koneksi();

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
            }
        }
    } else {
        $item_array = array(
            'id_barang'            =>    $_POST["hidden_id"],
            'nama_barang'          =>    $_POST["nama_barang"],
            'merek'                =>    $_POST["merek"],
            'kuantiti'             =>    $_POST["kuantiti"],
            'kdbarang'             =>    $_POST["kd_barang"],
            'stok'                 =>    $_POST["stok"]
        );
        $cart_data[] = $item_array;
    }


    $item_data = json_encode($cart_data);
    setcookie('cart_barang', $item_data, time() + (86400 * 30));
    header("location:barang.php?success=1");
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
                header("location:barang.php?remove=1");
            }
        }
    }
    if ($_GET["action"] == "clear") {
        setcookie("cart_barang", "", time() - 3600);
        header("location:barang.php?clearall=1");
    }
}

if (isset($_GET["success"])) {
    $message = '
	<div class="alert alert-primary alert-dismissible mb-0 mx-1 mb-1 flex-grow-1">
	  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	Item Telah Ditambahkan Dikeranjang
	</div>
	';
}

if (isset($_GET["remove"])) {
    $message = '
	<div class="alert alert-primary alert-dismissible mb-0 mx-4 mb-2 flex-grow-1">
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>

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
                        <h3>List Barang</h3>
                        <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables</p>
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
                        <div class="cart d-flex align-items-center">
                            <button type="button" class="btn btn-primary mx-4 " data-bs-toggle="modal" data-bs-target="#cart"><i class="bi bi-cart3"></i></button>
                            <?= $message ?>
                        </div>
                    </div>

                    <style>
                        .cart {
                            display: flex;
                            align-items: left;
                        }

                        /* .cart button {
                            flex-grow: 1;
                        } */

                        .alert {
                            margin-left: 10px;
                        }
                    </style>


                    <?php
                    $result = $kon->kueri("SELECT * FROM tb_barang ORDER BY id_barang ASC");
                    ?>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merek</th>
                                    <th>Jumlah Stock</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row) { ?>
                                    <tr>
                                        <td><?= $row["kd_barang"] ?></td>
                                        <td><?= $row["nama_barang"] ?></td>
                                        <td><?= $row["merek"] ?></td>
                                        <td><?= $row["stok"] ?></td>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="kuantiti" value="1" class="form-control" />
                                                <input type="hidden" name="nama_barang" value="<?php echo $row["nama_barang"]; ?>" />
                                                <input type="hidden" name="kd_barang" value="<?php echo $row["kd_barang"]; ?>" />
                                                <input type="hidden" name="merek" value="<?php echo $row["merek"]; ?>" />
                                                <input type="hidden" name="stok" value="<?php echo $row["stok"]; ?>" />
                                                <input type="hidden" name="hidden_id" value="<?php echo $row["id_barang"]; ?>" />
                                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-primary" value="Tambah" />

                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
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




                        <div style="clear:both"></div>
                        <div class="table-responsive">

                            <div align="right">
                                <a href="barang.php?action=clear"><b>Clear Cart</b></a>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="10%">Kode Barang</th>
                                    <th width="30%">Nama Barang</th>
                                    <th width="20%">Merek</th>
                                    <th width="5%">Stok</th>
                                    <th width="14%">Kuantiti</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                                <?php
                                if (isset($_COOKIE["cart_barang"])) {
                                    $total = 0;
                                    $cookie_data = stripslashes($_COOKIE['cart_barang']);
                                    $cart_data = json_decode($cookie_data, true);
                                    foreach ($cart_data as $keys => $values) {
                                ?>
                                        <tr>
                                            <td><?php echo $values["kdbarang"]; ?></td>
                                            <td><?php echo $values["nama_barang"]; ?></td>
                                            <td><?php echo $values["merek"]; ?></td>
                                            <td><?php echo $values["stok"]; ?></td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-outline-primary minus-btn" type="button">-</button>
                                                    <input type="text" class="form-control text-center quantity-input" value="1" min="1" max="<?= $values["stok"] ?>" aria-label="Example text with button addon" aria-describedby="button-addon1" data-idbarang="<?= $values["id_barang"] ?>">
                                                    <button class="btn btn-outline-primary plus-btn" type="button">+</button>
                                                </div>
                                            </td>
                                            <td><a href="barang.php?action=delete&id=<?php echo $values["id_barang"]; ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></span></a></td>
                                        </tr>
                                    <?php
                                        // $total = $total + ($values["kuantiti"] * $values["merek"]);
                                    }
                                    ?>

                                <?php
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
                        <button type="button" class="btn btn-primary">Chekout Barang</button>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="https://saugi.me">Saugi</a></p>
                </div>
            </div>
        </footer>
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


    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>

</body>

</html>