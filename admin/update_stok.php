<?php
session_start();
if (!isset($_SESSION['teknisi_id'])) {
    header("Location: login.php");
    exit();
}
include_once "../proses/koneksi.php";
$kon = new Koneksi();
$count_data = $kon->kueri("SELECT status, merek, nama_barang, COUNT(*) as total FROM tb_inventaris GROUP BY status, merek, nama_barang");
while ($row = $kon->hasil_data($count_data)) {
    $status = $row['status'];
    $merek = $row['merek'];
    $nama_barang = $row['nama_barang'];
    $total = $row['total'];
    //buatkan saya update ke tabel tb_barang hasil count masukan kedalam field stok tanpa marus membuka halaman ini lagi
    $update =  $kon->kueri("UPDATE tb_barang SET stok = '$total' WHERE status = '$status' AND merek = '$merek' AND nama_barang = '$nama_barang'");
}
?>
<meta http-equiv="refresh" content="0; url=listbarang.php">