<?php
session_start();
if (!isset($_SESSION['teknisi_id'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Memastikan bahwa data 'ktm' telah dikirim
  if (isset($_POST['ktm'])) {
    $ktm = $_POST['ktm'];
    die;
    //   // Lakukan pemrosesan data sesuai kebutuhan Anda
    //   // Misalnya, simpan data ke database atau lakukan tindakan lainnya

    //   // Mengirimkan tanggapan JSON jika diperlukan
    //   $response = array('status' => 'success', 'message' => 'Data KTM berhasil diterima');
    //   echo json_encode($response);
    // } else {
    //   $response = array('status' => 'error', 'message' => 'Data KTM tidak ditemukan');
    //   echo json_encode($response);
    // }
  }
}

?>

<html lang="en">
<?php include_once "template/header.php" ?>
<style>
  form {
    background: #fff;
    margin: 10px auto;
    padding: 15px 40px 40px 40px;
    width: 100%;
  }

  .tab p {
    font-size: 20px;
    margin: 0 0 10px 0;
  }

  /* input {
    margin: 10px 0;
    padding: 10px;
    box-sizing: border-box;
    width: 100%;
    font-size: 17px;
    border: 1px solid #aaaaaa;
  } */

  .index-btn-wrapper {
    display: flex;
  }

  .index-btn {
    margin: 20px 15px 0 0;
    background: #04AA6D;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    cursor: pointer;
    transition: 0.3s;
  }

  .index-btn:hover {
    opacity: 0.8;
  }

  .step {
    height: 30px;
    width: 30px;
    line-height: 30px;
    margin: 0 2px;
    color: white;
    background: blue;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.25;
  }
</style>

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
            <h3>Pengembalian Barang</h3>
            <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables</p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengembalian Barang</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <section class="section">
        <div class="card">
          <div class="card-header">
            Data Pengembalian Barang
          </div>
          <div class="card-body  ">
            <div class="container box  ">
              <form id="myForm" action="" method="post" autocomplete="off">
                <h1 align=center>Data Pengembalian</h1>

                <div style="text-align:center;">
                  <span class="step" id="step-1">1</span>
                  <span class="step" id="step-2">2</span>
                  <span class="step" id="step-3">3</span>
                  <span class="step" id="step-4">4</span>
                </div>

                <div class="tab" id="tab-1">
                  <p>RFID KTM:</p>
                  <form>
                    <input class="form form-control" id="ktm" type="text" placeholder="Tap KTM" name="ktm">
                    <div class="index-btn-wrapper">
                      <div class="index-btn btn btn-primary " onclick="run(1, 2); kirimdata();">Next</div>
                    </div>
                  </form>

                  <script>
                    function kirimdata() {
                      var ktm = document.getElementById('ktm').value;

                      // Data yang akan dikirim
                      var data = {
                        ktm: ktm
                      };

                      // Konfigurasi permintaan POST
                      var options = {
                        method: 'POST',
                        headers: {
                          'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                      };

                      // Kirim permintaan POST menggunakan Fetch API
                      fetch('url_target', options)
                        .then(response => response.json())
                        .then(data => {
                          // Tanggapan dari server
                          console.log(data);
                        })
                        .catch(error => {
                          console.error('Terjadi kesalahan:', error);
                        });
                    }
                  </script>

                </div>
            </div>

            <div class="tab" id="tab-2">
              <p>Data Barang <?= $ktm ?></p>
              <div class="form-group">
                <label for="formGroupExampleInput">Example label</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Another label</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
              </div>
              <div class="index-btn-wrapper">
                <div class="index-btn btn btn-primary" onclick="run(2, 1);">Previous</div>
                <div class="index-btn btn btn-primary" onclick="run(2, 3);">Next</div>
              </div>
            </div>

            <div class="tab" id="tab-3">
              <p>Contact Info:</p>
              <div class="form-group">
                <label for="formGroupExampleInput">Example label</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Another label</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
              </div>
              <div class="index-btn-wrapper">
                <div class="index-btn btn btn-primary" onclick="run(3, 2);">Previous</div>
                <div class="index-btn btn btn-primary" onclick="run(3, 4);">Next</div>
              </div>
            </div>

            <div class="tab" id="tab-4">
              <p>Login Info:</p>
              <input type="text" class="form form-control" placeholder="Username" name="username">
              <input type="password" class="form form-control" placeholder="Password" name="password">
              <div class="index-btn-wrapper">
                <div class="index-btn btn btn-primary" onclick="run(4, 3);">Previous</div>
                <div class="index-btn btn btn-primary" onclick="run(4, 5);">Next</div>
              </div>
            </div>

            <div class="tab" id="tab-5">
              <div class="index-btn-wrapper">
                <div class="index-btn btn btn-primary" onclick="run(5, 4);">Previous</div>
                <button class="index-btn btn btn-primary" type="submit" name="submit" style="background: blue;">Submit</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </section>
    </div>


    <?php include_once 'template/footer.php' ?>
    <script>
      // Default tab
      $(".tab").css("display", "none");
      $("#tab-1").css("display", "block");

      function run(hideTab, showTab) {
        if (hideTab < showTab) { // If not press previous button
          // Validation if press next button
          var currentTab = 0;
          x = $('#tab-' + hideTab);
          y = $(x).find("input")
          for (i = 0; i < y.length; i++) {
            if (y[i].value == "") {
              $(y[i]).css("background", "#ffdddd");
              return false;
            }
          }
        }

        // Progress bar
        for (i = 1; i < showTab; i++) {
          $("#step-" + i).css("opacity", "1");
        }

        // Switch tab
        $("#tab-" + hideTab).css("display", "none");
        $("#tab-" + showTab).css("display", "block");
        $("input").css("background", "#fff");
      }
    </script>


</body>


</html>