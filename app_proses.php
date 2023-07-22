<?php
// include_once "proses/koneksi.php";
// $kon = new koneksi();


// function generateRandomString($length = 6)
// {
//     $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, strlen($characters) - 1)];
//     }
//     return $randomString;
// }

// // Fungsi untuk menghasilkan NRP acak
// function generateRandomNRP()
// {
//     return 'NRP' . rand(100000, 999999);
// }

// // Menghasilkan dan mengeksekusi 200 pernyataan INSERT acak
// for ($i = 0; $i < 250; $i++) {
//     $id_mahasiswa = $i + 1; // Anggap id_mahasiswa dimulai dari 1
//     $id_rfid = 'RFID' . rand(100000, 999999);
//     $nama_mahasiswa = generateRandomString(10);
//     $nrp = generateRandomNRP();
//     $kelas = 'Kelas ' . rand(1, 10);
//     $email = generateRandomString(6) . '@example.com';
//     $denda = rand(0, 50000);
//     $pass = password_hash(generateRandomString(8), PASSWORD_DEFAULT); // Anggap Anda ingin menyimpan password terenkripsi

//     $sql = $kon->kueri("INSERT INTO tb_mahasiswa (id_mahasiswa, id_rfid, nama_mahasiswa, nrp, kelas, email, denda, pass) 
//     VALUES ('$id_mahasiswa', '$id_rfid', '$nama_mahasiswa', '$nrp', '$kelas', '$email', '$denda', '$pass')");
// }


// // Function untuk menghasilkan string acak
// function generateRandomString($length = 6)
// {
//     $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, strlen($characters) - 1)];
//     }
//     return $randomString;
// }

// // Function untuk menghasilkan nilai acak untuk status dan proses
// function generateRandomStatus()
// {
//     $statuses = array('Baru', 'Bekas');
//     return $statuses[rand(0, count($statuses) - 1)];
// }

// function generateRandomProses()
// {
//     $processes = array('Selesai', 'Belum Selesai');
//     return $processes[rand(0, count($processes) - 1)];
// }

// // Menghasilkan dan mengeksekusi 250 data acak
// for ($i = 0; $i < 250; $i++) {
//     $id_inventaris = $i + 1; // Anggap id_inventaris dimulai dari 1
//     $id_barang = 'BRG' . rand(100000, 999999);
//     $kd_barang = 'KD' . rand(1000, 9999);
//     $nama_barang = generateRandomString(10);
//     $merek = generateRandomString(6);
//     $status = 1;
//     $proses = 1;

//     $sql = $kon->kueri("INSERT INTO tb_inventaris (id_inventaris, id_barang, kd_barang, nama_barang, merek, status, proses) 
//             VALUES ('$id_inventaris', '$id_barang', '$kd_barang', '$nama_barang', '$merek', '$status', '$proses')");
// }



// // Function untuk menghasilkan string acak
// function generateRandomString($length = 6)
// {
//     $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, strlen($characters) - 1)];
//     }
//     return $randomString;
// }

// // Function untuk menghasilkan tanggal secara acak antara dua tanggal
// function generateRandomDate($start_date, $end_date)
// {
//     $min = strtotime($start_date);
//     $max = strtotime($end_date);

//     $randomTimestamp = mt_rand($min, $max);

//     return date('d F Y', $randomTimestamp);
// }

// // Data awal untuk tanggal peminjaman
// $today = date('d F Y');

// // Membuat 480 data acak untuk setiap bulan dalam setahun (40 data setiap bulan)
// for ($bulan = 1; $bulan <= 12; $bulan++) {
//     for ($i = 1; $i <= 40; $i++) {
//         $id_pinjam = ($bulan - 1) * 40 + $i;
//         $id_mahasiswa = $i;
//         $id_rfid = 'RFID' . rand(100000, 999999);
//         $nama_mahasiswa = generateRandomString(10);
//         $kd_barang = 'KD' . rand(1000, 9999);
//         $nama_barang = generateRandomString(10);
//         $merek = generateRandomString(6);
//         $kuantiti = rand(1, 5); // Jumlah acak antara 1 hingga 5
//         $tgl_pinjam = generateRandomDate($today, date('d F Y', strtotime('+1 year', strtotime($today))));
//         $tgl_batas_kembali = date('d F Y', strtotime('+5 days', strtotime($tgl_pinjam)));
//         $tgl_kembali = date('d F Y', strtotime('+5 days', strtotime($tgl_pinjam)));
//         $status = '4';

//         $sql = $kon->kueri("INSERT INTO tb_peminjaman (id_pinjam, id_mahasiswa, id_rfid, nama_mahasiswa, kd_barang, nama_barang, merek, kuantiti, tgl_pinjam, tgl_batas_kembali, tgl_kembali, status) 
//                 VALUES ('$id_pinjam', '$id_mahasiswa', '$id_rfid', '$nama_mahasiswa', '$kd_barang', '$nama_barang', '$merek', '$kuantiti', '$tgl_pinjam', '$tgl_batas_kembali', '$tgl_kembali', '$status')");
//     }
// }
