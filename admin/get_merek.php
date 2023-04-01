<?php
//koneksi ke database
include_once "../proses/koneksi.php";
$kon = new Koneksi();
$get = $_POST['nama_barang'];
//koneksi ke database
$query = $kon->kueri("SELECT * FROM tb_barang WHERE nama_barang = '$get' ");
//mengambil data dan menuliskan ke dalam format JSON  
$data = array();
foreach ($query as $row) {
    $data[] = array('id' => $row['nama_barang'], 'text' => $row['merek']);
}
echo json_encode($data);
