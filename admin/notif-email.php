<?php
include_once "../proses/koneksi.php";
$kon = new Koneksi();

$kueri = $kon->kueri("SELECT 
    p.id_pinjam, p.id_mahasiswa, p.id_rfid, p.nama_mahasiswa, p.kd_barang,
    p.nama_barang, p.merek, p.kuantiti, p.tgl_pinjam, p.tgl_batas_kembali,
    p.tgl_kembali, p.status, m.email
    FROM 
    tb_peminjaman p
    INNER JOIN 
    tb_mahasiswa m ON p.id_mahasiswa = m.id_mahasiswa;
");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'assets/email/vendor/autoload.php';


foreach ($kueri as $row) {
    $tgl_batas_kembali = $row['tgl_batas_kembali'];
    $email = $row['email'];
    $nama  = $row['nama_mahasiswa'];

    $tgl_sekarang = date('d F Y');
    $tgl_batas_kirim = date('d F Y', strtotime('-2 days', strtotime($tgl_batas_kembali)));
    if ($tgl_sekarang >= $tgl_batas_kirim) {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'ailab.cyberpink.my.id';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ailab@ailab.cyberpink.my.id';                     //SMTP username
        $mail->Password   = 'ailab2023lulus';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                   // TCP port to connect to
        $mail->SMTPDebug = 0; // Nonaktifkan log
        $mail->setFrom('ailab@ailab.cyberpink.my.id', 'Ailab');
        $mail->addAddress($email, 'Mahasiswa');     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Peringatan Pengembalian Barang';
        $mail->Body    =  "Yth. Mahasiswa, $nama <br> <br> Jatuh tempo pengembalian barang yang anda dipinjam adalah <b>$tgl_batas_kembali</b>. Mohon segera melakukan pengembalian barang.<br> <br> Salam Hangat, Ailab <br>Terima Kasih";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo '<script>alert("Pesan Gagal Terkirim / Periksa Jaringan");</script>';
        } else {
            // $abc = $kon->kueri("UPDATE tabel_pesan SET status_kirim = '2' WHERE id = '$idpesan' ");
            echo '<script>alert("Pesan Terkirim");</script>';
        }
        // Kirim email ke $email
        // Implementasikan pengiriman email menggunakan library atau fungsi yang sesuai
    }
}


//jika batas kembali kurangi dari 2 hari maka kirim email
