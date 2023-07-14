<?php
/*call the FPDF library*/
require('assets/fpdf/fpdf.php');

include_once "proses/koneksi.php";

$idpinjam = $_GET['id'];
$kon = new koneksi();
$kueri = $kon->kueri("SELECT * FROM tb_peminjaman where id_pinjam = '$idpinjam' AND status != '3' AND status != '4' ");
$data = $kon->hasil_data($kueri);
if ($data['status'] == 1) {
    $data['status'] = "Disetujui";
} else if ($data['status'] == 2) {
    $data['status'] = "Dipinjam";
} elseif ($data['status'] == 0) {
    $data['status'] = "Menunggu Persetujuan";
}


$arrbarang = explode(",", $data['nama_barang']);
$arrmerek = explode(",", $data['merek']);
$arrkuantiti = explode(",", $data['kuantiti']);

// foreach ($arrbarang as $key => $value) {
//     $arrbarang[$key] = $arrbarang[$key] . " " . $arrmerek[$key] . " " . $arrkuantiti[$key];
//     echo $arrbarang[$key];
// }

// die;

class Invoice extends FPDF
{
    function Header()
    {
        // Logo perusahaan
        $this->Image('img/logo1.png', 1, 1, 1.4);

        // Judul Invoice
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 2, 'Invoice Peminjaman', 0, 1, 'R');

        // Garis pemisah
        $this->SetLineWidth(0.05);
        $this->Line(1, $this->GetY(), $this->GetPageWidth() - 1, $this->GetY());
        $this->Ln(0.5);
    }

    function Content($customerInfo, $invoiceDetails)
    {
        // Informasi pelanggan
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 1, 'Informasi Peminjaman:', 0, 1, 'L');
        $this->Ln(0.5);
        $this->Cell(4.5, 1, 'Nama:', 0, 0, 'L');
        $this->Cell(0, 1, $customerInfo['nama'], 0, 1, 'L');
        $this->Cell(4.5, 1, 'ID RFID :', 0, 0, 'L');
        $this->Cell(0, 1, $customerInfo['idrfid'], 0, 1, 'L');
        $this->Cell(4.5, 1, 'Tanggal Peminjaman :', 0, 0, 'L');
        $this->Cell(0, 1, $customerInfo['tglpinjam'], 0, 1, 'L');
        $this->Cell(4.5, 1, 'Tanggal Batas Kembali :', 0, 0, 'L');
        $this->Cell(0, 1, $customerInfo['tglkembali'], 0, 1, 'L');
        $this->Cell(4.5, 1, 'Status :', 0, 0, 'L');
        $this->Cell(0, 1, $customerInfo['status'], 0, 1, 'L');
        $this->Ln(0.5);

        // Detail invoice
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 1, 'Detail Peminjaman:', 0, 1, 'L');
        $this->Ln(0.5);
        $this->Cell(1, 1, 'No.', 1, 0, 'C');
        $this->Cell(7, 1, 'Nama Barang', 1, 0, 'C');
        $this->Cell(7, 1, 'Spesifikasi', 1, 0, 'C');
        $this->Cell(1, 1, 'Qty', 1, 1, 'C');

        $this->SetFont('Arial', '', 11);
        $no = 1;
        foreach ($invoiceDetails as $detail) {

            $this->Cell(1, 1, $no++, 1, 0, 'C');
            $this->Cell(7, 1, $detail['namabarang'], 1, 0, 'C');
            $this->Cell(7, 1, $detail['merek'], 1, 0, 'C');
            $this->Cell(1, 1, $detail['kuantiti'], 1, 1, 'C');
        }
    }

    function Footer()
    {
        // Teks footer
        $this->SetY(-2.5);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 1, 'Terima kasih atas kunjungan Anda!', 0, 0, 'C');
    }
}



// Data dummy
$customerInfo = array(
    'nama' => $data['nama_mahasiswa'],
    'idrfid' => $data['id_rfid'],
    'tglpinjam' => $data['tgl_pinjam'],
    'tglkembali' => $data['tgl_batas_kembali'],
    'status' => $data['status']
);
$invoiceDetails = array();

foreach ($arrbarang as $key => $value) {
    $barang = $arrbarang[$key];
    $merek = $arrmerek[$key];
    $kuantiti = $arrkuantiti[$key];

    // Menambahkan data ke array $invoiceDetails
    $invoiceDetails[] = array(
        'namabarang' => $barang,
        'merek' => $merek,
        'kuantiti' => $kuantiti
    );
}


// Membuat objek invoice
$pdf = new Invoice('P', 'cm', array(17.6, 25));

// Menambahkan halaman
$pdf->AddPage();

// Memanggil fungsi Content()
$pdf->Content($customerInfo, $invoiceDetails);

// Menampilkan output PDF
$pdf->Output();
