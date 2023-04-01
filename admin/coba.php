<!DOCTYPE html>
<html>

<head>
    <title>Contoh Dependent Dropdown dengan Select2 dan PHP</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body>

    <!-- Button untuk membuka modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">Tambah Data</button>

    <!-- Modal untuk form -->
    <div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modal-tambah-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-tambah-label">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="select-barang">Barang</label>
                            <select class="form-control select-barang" name="id_barang" id="select-barang">
                                <option value="">Pilih Barang</option>
                                <?php
                                //koneksi ke database
                                $host = 'localhost';
                                $user = 'root';
                                $pass = '';
                                $dbname = 'nama_database';

                                $conn = mysqli_connect($host, $user, $pass, $dbname);

                                if (mysqli_connect_errno()) {
                                    echo "Koneksi ke database gagal: " . mysqli_connect_error();
                                    exit();
                                }

                                $query = mysqli_query($conn, "SELECT * FROM tb_barang");
                                while ($row = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $row['id_barang'] . '">' . $row['nama_barang'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="select-merek">Merek</label>
                            <select class="form-control select-merek" name="id_merek" id="select-merek">
                                <option value="">Pilih Merek</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
        // Ketika dropdown select-barang dipilih
        $('.select-barang').on('select2:select', function(e) {
            // Ambil ID barang yang dipilih
            var id_barang = e.params.data.id;

            // Buat AJAX request ke script get_merek.php untuk mengambil merek-merek yang tersedia			$.ajax({
            type: "POST",
                url: "get_merek.php",
                data: {
                    id_barang: id_barang
                },
                dataType: 'json',
                success: function(response) {
                    // Kosongkan dropdown select-merek
                    $('#select-merek').empty();

                    // Tambahkan option "Pilih Merek"
                    $('#select-merek').append('<option value="">Pilih Merek</option>');

                    // Loop response dan tambahkan option merek-merek yang tersedia
                    $.each(response, function(index, value) {
                        $('#select-merek').append('<option value="' + value.id_merek + '">' + value.nama_merek + '</option>');
                    });

                    // Aktifkan Select2 pada dropdown select-merek
                    $('.select-merek').select2({
                        dropdownParent: $('#modal-tambah')
                    });
                }
        });
        });
        });
    </script>