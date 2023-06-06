<?php
include_once "../proses/koneksi.php";
$kon = new Koneksi();

$kueri = $kon->kueri("SELECT id_chekout, id_barang, id_inventaris, kd_barang, nama_mahasiswa, nama_barang, merek, kuantiti, status FROM tb_chekout");
$value = $kon->hasil_array($kueri);


foreach ($value as $data) {
    $id_chekout_array = explode(",", $data["id_chekout"]);
    $first_id_chekout = $id_chekout_array[0];

    $kd_barang_array = explode(",", $data["kd_barang"]);
    $first_kd_barang = $kd_barang_array[0];

    $nama_mahasiswa_array = explode(",", $data["nama_mahasiswa"]);
    $first_nama_mahasiswa = $nama_mahasiswa_array[0];

    $nama_barang_array = explode(",", $data["nama_barang"]);
    $first_nama_barang = $nama_barang_array[0];

    $merek_array = explode(",", $data["merek"]);
    $first_merek = $merek_array[0];

    $kuantiti_array = explode(",", $data["kuantiti"]);
    $first_kuantiti = $kuantiti_array[0];

    $status_array = explode(",", $data["status"]);
    $first_status = $status_array[0];

    $json =  $first_id_chekout . "," . $first_kd_barang . "," . $first_nama_mahasiswa . "," . $first_nama_barang . "," . $first_merek . "," . $first_kuantiti . "," . $first_status;

    $arrayData = explode(",", $json);

    $keys = ['id_chekout', 'kd_barang', 'nama_mahasiswa', 'nama_barang', 'merek', 'kuantiti', 'status'];
    $combinedArray = array_combine($keys, $arrayData);

    $dataArray[] = $combinedArray;
}

$jsonData = json_encode($dataArray);

echo '{"data":' . $jsonData . '}';
