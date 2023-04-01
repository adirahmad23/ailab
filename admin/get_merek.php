<?php
//koneksi ke database
include_once "../proses/koneksi.php";
$kon = new Koneksi();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];

    $query = $kon->kueri("SELECT * FROM tb_barang WHERE nama_barang = '$nama_barang'");

    $data = array();
    while ($row = $kon->hasil_data($query)) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}
