<?php
session_start();
include_once 'koneksi.php'; 
$kon = new Koneksi();

$nrp =@$_POST['tnrp'];
$pass =@$_POST['tpass'];

$abc = $kon->kueri("SELECT * FROM tb_mahasiswa WHERE  nrp = '$nrp' AND pass = MD5('$pass') ");
$jumlah = $kon->jumlah_data($abc);
if($jumlah == 0) {
	echo "<script>alert ('Login Gagal atau Belum Punya Akun!');</script>";
	header('Location: ../login.php');
    
}else{
	$hasil = $kon->hasil_data($abc);
	$_SESSION['email_peserta'] = $hasil['id_peserta'];
	$_SESSION['email_peserta1'] = $hasil['email'];
	$_SESSION['telp'] = $hasil['telp'];
	$_SESSION['jenislomba'] = $hasil['jenis_lomba'];
	echo "<script>alert ('Selamat Datang');</script>";
	header("location: index.php");

}


?>
 <!-- <meta http-equiv="refresh" content="0;URL=index.php" />  -->