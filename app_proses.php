<?php
include_once "proses/koneksi.php";
$kon = new koneksi();
// $id = $_GET['id'];
// // $kd = $_GET['kd'];
$tampil = $kon->kueri("SELECT * FROM tb_chekout WHERE id_chekout = '$id'");
$var = $kon->hasil_data($tampil);
var_dump($var);
