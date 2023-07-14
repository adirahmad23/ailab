<?php
include_once "proses/koneksi.php";
$kon = new Koneksi();
session_start();
if (!isset($_SESSION['mahasiswa_id'])) {
    header("Location: login.php");
    exit();
}
$idmhsw = $_SESSION['mahasiswa_id'];
$kueri = $kon->kueri("SELECT * FROM tb_peminjaman WHERE id_mahasiswa = '$idmhsw' AND (status = '0' OR status = '1' OR status = '2')  ");
$value = $kon->hasil_array($kueri);


foreach ($value as $data) {
    // $id_chekout_array = explode(",", $data["id_chekout"]);
    // $first_id_chekout = $id_chekout_array[0];

    $kd_barang_array = explode(",", $data["kd_barang"]);
    $first_kd_barang = $kd_barang_array[0];

    $nama_mahasiswa_array = explode(",", $data["nama_mahasiswa"]);
    $first_nama_mahasiswa = $nama_mahasiswa_array[0];

    $nama_barang_array = explode(",", $data["nama_barang"]);
    $first_nama_barang = $nama_barang_array[0];

    $merek_array = explode(",", $data["merek"]);
    $first_merek = $merek_array[0];

    $tgl_pinjam_array = explode(",", $data["tgl_pinjam"]);
    $first_tgl_pinjam = $tgl_pinjam_array[0];

    $tgl_batas_kembali_array = explode(",", $data["tgl_batas_kembali"]);
    $first_tgl_batas_kembali = $tgl_batas_kembali_array[0];

    $invoice = '<a href="invoice.php?id=' . $data['id_pinjam'] . '" class="btn btn-primary " target="_blank"><i class="bi bi-printer-fill"></i></a>';


    $kuantiti_array = explode(",", $data["kuantiti"]);
    $first_kuantiti = $kuantiti_array[0];


    if ($data['status'] == 0) {
        $data['status'] = '<span class="badge bg-secondary">Menunggu Persetujuan</span>';
    } else if ($data['status'] == 1) {
        $data['status'] = '<span class="badge bg-primary">Disetujui</span>';
    } else if ($data['status'] == 2) {
        $data['status'] = '<span class="badge bg-success">Dipinjam</span>';
    }

    $status_array = explode(",", $data["status"]);
    $first_status = $status_array[0];

    $json =   $first_kd_barang . "," . $first_nama_mahasiswa . "," . $first_nama_barang . "," . $first_merek . "," . $first_kuantiti .  "," . $first_tgl_pinjam . ","  . $first_tgl_batas_kembali . "," . $invoice . "," . $first_status;
    $arrayData = explode(",", $json);

    $keys = ['kd_barang', 'nama_mahasiswa', 'nama_barang', 'merek', 'kuantiti', 'tgl_pinjam', 'tgl_batas_kembali', 'invoice', 'status'];
    $combinedArray = array_combine($keys, $arrayData);

    $dataArray[] = $combinedArray;
}

$jsonData = json_encode($dataArray);

echo '{"data":' . $jsonData . '}';
