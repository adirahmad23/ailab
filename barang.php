<?php

//barang.php

include "koneksi.php";
$kon = new Koneksi();

$message = '';

if (isset($_POST["add_to_cart"])) {
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);

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
            'nama_barang'        =>    $_POST["nama_barang"],
            'merek'                =>    $_POST["merek"],
            'kuantiti'            =>    $_POST["kuantiti"],
            'kdbarang'            =>    $_POST["kd_barang"],
        );
        $cart_data[] = $item_array;
    }


    $item_data = json_encode($cart_data);
    setcookie('shopping_cart', $item_data, time() + (86400 * 30));
    header("location:barang.php?success=1");
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        foreach ($cart_data as $keys => $values) {
            if ($cart_data[$keys]['id_barang'] == $_GET["id"]) {
                unset($cart_data[$keys]);
                $item_data = json_encode($cart_data);
                setcookie("shopping_cart", $item_data, time() + (86400 * 30));
                header("location:barang.php?remove=1");
            }
        }
    }
    if ($_GET["action"] == "clear") {
        setcookie("shopping_cart", "", time() - 3600);
        header("location:barang.php?clearall=1");
    }
}

if (isset($_GET["success"])) {
    $message = '
	<div class="alert alert-success alert-dismissible">
	  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	Item Added into Cart
	</div>
	';
}

if (isset($_GET["remove"])) {
    $message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Item removed from Cart
	</div>
	';
}
if (isset($_GET["clearall"])) {
    $message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Your Shopping Cart has been clear...
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
                                <li class="breadcrumb-item"><a href="barang.php">Dashboard</a></li>
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
                                        <td><?= $row["kuantiti"] ?></td>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="kuantiti" value="1" class="form-control" />
                                                <input type="hidden" name="nama_barang" value="<?php echo $row["nama_barang"]; ?>" />
                                                <input type="hidden" name="kd_barang" value="<?php echo $row["kd_barang"]; ?>" />
                                                <input type="hidden" name="merek" value="<?php echo $row["merek"]; ?>" />
                                                <input type="hidden" name="hidden_id" value="<?php echo $row["id_barang"]; ?>" />
                                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

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

                <div style="clear:both"></div>
                <br />
                <h3>Order Details</h3>
                <div class="table-responsive">
                    <?php echo $message; ?>
                    <div align="right">
                        <a href="barang.php?action=clear"><b>Clear Cart</b></a>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Kode Barang</th>
                            <th width="10%">Nama Barang</th>
                            <th width="20%">Merek</th>
                            <th width="15%">Kuantiti</th>
                            <th width="5%">Aksi</th>
                        </tr>
                        <?php
                        if (isset($_COOKIE["shopping_cart"])) {
                            $total = 0;
                            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                            $cart_data = json_decode($cookie_data, true);
                            foreach ($cart_data as $keys => $values) {
                        ?>
                                <tr>
                                    <td><?php echo $values["kdbarang"]; ?></td>
                                    <td><?php echo $values["nama_barang"]; ?></td>
                                    <td><?php echo $values["merek"]; ?></td>
                                    <td><?php echo $values["kuantiti"] ?></td>
                                    <td><a href="barang.php?action=delete&id=<?php echo $values["id_barang"]; ?>"><span class="text-danger">Remove</span></a></td>
                                </tr>
                            <?php
                                // $total = $total + ($values["kuantiti"] * $values["merek"]);
                            }
                            ?>

                        <?php
                        } else {
                            echo '
				<tr>
					<td colspan="5" align="center">No Item in Cart</td>
				</tr>
				';
                        }
                        ?>
                    </table>
                </div>
            </section>
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
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>

</body>

</html>