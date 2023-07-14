<?php
include_once "../proses/koneksi.php";
date_default_timezone_set('Asia/Jakarta');

$kon = new Koneksi();
$kueri = $kon->kueri("SELECT 
    p.id_pinjam, p.id_mahasiswa, p.id_rfid, p.nama_mahasiswa, p.kd_barang,
    p.nama_barang, p.merek, p.kuantiti, p.tgl_pinjam, p.tgl_batas_kembali,
    p.tgl_kembali, p.status, m.email
    FROM 
    tb_peminjaman p
    INNER JOIN 
    tb_mahasiswa m ON p.id_mahasiswa = m.id_mahasiswa WHERE p.status = '2';
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
    if (strtotime($tgl_sekarang) >= strtotime($tgl_batas_kirim)) {
        if (strtotime($tgl_sekarang) > strtotime($tgl_batas_kembali)) {
            $diff = strtotime($tgl_sekarang) - strtotime($tgl_batas_kembali);
            $daysLate = ceil($diff / (60 * 60 * 24)); // Menghitung jumlah hari terlambat (pembulatan ke atas)
            $denda = $daysLate * 5000; // Denda per hari terlambat adalah 5000

            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'ailab.cyberpink.my.id';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ailab@ailab.cyberpink.my.id';
            $mail->Password   = 'ailab2023lulus';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->SMTPDebug = 0; // Nonaktifkan log
            $mail->setFrom('ailab@ailab.cyberpink.my.id', 'Ailab');
            $mail->addAddress($email, 'Mahasiswa');
            $mail->isHTML(true);

            $mail->Subject = 'Peringatan Keterlambatan Pengembalian Barang';
            $mail->Body    =  "Yth. Mahasiswa, $nama <br> <br>"
                . "Barang yang Anda pinjam seharusnya dikembalikan pada tanggal <b>$tgl_batas_kembali</b>,"
                . " namun hingga saat ini barang tersebut belum dikembalikan."
                . " Kami ingin mengingatkan Anda untuk segera mengembalikan barang tersebut."
                . " Jika barang tidak dikembalikan segera, Anda akan dikenakan denda keterlambatan"
                . " sebesar $denda rupiah untuk $daysLate hari terlambat."
                . " Terima kasih atas perhatiannya."
                . "<br> <br> Salam Hangat, Ailab <br>Terima Kasih";

            if (!$mail->send()) {
                // echo '<script>alert("Pesan Gagal Terkirim / Periksa Jaringan");</script>';
            } else {

                $kon->kueri("UPDATE tb_mahasiswa SET denda = '$denda' WHERE id_mahasiswa = '$row[id_mahasiswa]'");
            }

            // echo "Penalty fee for $nama ($email) is $denda";
            // echo "<br><br>";
        } else {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'ailab.cyberpink.my.id';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ailab@ailab.cyberpink.my.id';
            $mail->Password   = 'ailab2023lulus';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->SMTPDebug = 0; // Nonaktifkan log
            $mail->setFrom('ailab@ailab.cyberpink.my.id', 'Ailab');
            $mail->addAddress($email, 'Mahasiswa');
            $mail->isHTML(true);

            $mail->Subject = 'Peringatan Pengembalian Barang';
            $mail->Body    =  "Yth. Mahasiswa, $nama <br> <br> Jatuh tempo pengembalian barang yang anda dipinjam adalah <b>$tgl_batas_kembali</b>. Mohon segera melakukan pengembalian barang.<br> <br> Salam Hangat, Ailab <br>Terima Kasih";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                echo '<script>alert("Pesan Gagal Terkirim / Periksa Jaringan");</script>';
            }
            // echo "ada";
        }
    } else {
        // echo "tidak ada";
    }
}
