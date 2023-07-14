<?php

$idmhsw = $_SESSION['mahasiswa_id'];
?>
<script>
    // var kd = '213';

    function format(d) {
        // var id = d.id_chekout;
        // return ("id: " + id + "<br>");
        <?php

        // $id =; // Mendapatkan nilai id dari permintaan POST
        include_once "proses/koneksi.php";
        $kon = new koneksi();
        $tampil = $kon->kueri("SELECT * FROM tb_peminjaman where id_mahasiswa = '$idmhsw' AND (status = '0' OR status = '1' OR status = '2')");
        $var = $kon->hasil_array($tampil);
        ?>
        var hasil = <?php echo json_encode($var); ?>;
        var result = '';

        // Iterasi menggunakan forEach()
        hasil.forEach(function(data) {
            result += '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" width="100%">' +
                "<tr>" +
                "<td width='10%'>Nama Mahasiswa:</td>" +
                "<td>" +
                data.nama_mahasiswa +
                "</td>" +
                "</tr>" +
                "<tr>" +
                "<td width='10%'>Kode Barang:</td>" +
                "<td>" +
                data.kd_barang +
                "</td>" +
                "</tr>" +
                "<tr>" +
                "<td>Nama Barang:</td>" +
                "<td>" +
                data.nama_barang +
                "</td>" +
                "</tr>" +
                "<tr>" +
                "<td>Merek:</td>" +
                "<td>" +
                data.merek +
                "</td>" +
                "</tr>" +
                "<tr>" +
                "<td>Kuantiti:</td>" +
                "<td>" +
                data.kuantiti +
                "</td>" +
                "</tr>" +
                // "<tr>" +
                // "<td>Status:</td>" +
                // "<td>" +
                // data.status +
                // "</td>" +
                // "</tr>" +
                "</table>";
        });

        // Mengembalikan hasil iterasi
        return result;
        // }


    }

    $(document).ready(function() {
        var table = $("#example").DataTable({
            ajax: {
                url: "bacajson.php"
            },
            columns: [{
                    className: "dt-control",
                    orderable: false,
                    data: null,
                    defaultContent: "",
                },
                {
                    data: "nama_mahasiswa"
                },
                {
                    data: "kd_barang"
                },
                {
                    data: "nama_barang"
                },
                {
                    data: "merek"
                },
                {
                    data: "kuantiti"
                },
                {
                    data: "tgl_pinjam"
                },
                {
                    data: "tgl_batas_kembali"
                },
                {
                    data: "invoice"
                },
                {
                    data: "status"
                },
            ],
            order: [
                [1, "asc"]
            ],
        });

        // Add event listener for opening and closing details
        $("#example tbody").on("click", "td.dt-control", function() {
            var tr = $(this).closest("tr");
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass("shown");
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass("shown");
            }
        });
    });
</script>