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

            <div class="cart d-flex align-items-center">
              <button type="button" class="btn btn-primary mx-4 " data-bs-toggle="modal" data-bs-target="#cart"><i class="bi bi-cart3"></i></button>
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
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
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
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    This is the modal body.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <div align="right">
                <a href="inventaris.php?action=clear"><b>Clear Cart</b></a>
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

    <?php include_once 'template/footer.php' ?>

  </div>
  </div>

  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/app.js"></script>

  <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
  <script src="assets/js/pages/simple-datatables.js"></script>

</body>

</html>