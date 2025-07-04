<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('fpdf/fpdf.php');
include('../koneksi.php');

class PDF extends FPDF {
    function Header() {
        // Logo kampus //
      $this->Image('../images/Unsub.png', 10, 10, 25);


        // Kop surat
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 7, 'PROGRAM STUDI SISTEM INFORMASI ', 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 6, 'Fakultas Komputer, Universitas Subang', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 5, 'Jl. Raden Ajeng Kartini,Kabupaten Subang, Jawa Barat 41215', 0, 1, 'C');

        // Garis bawah
        $this->Ln(5);
        $this->Line(10, 35, 200, 35);
        $this->Ln(10);
    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();

// Judul
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'LAPORAN PESAN KONTAK WEBSITE PERSONAL',0,1,'C');
$pdf->Ln(4);

// Header tabel
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(230, 230, 250);
$pdf->Cell(10,8,'No',1,0,'C',true);
$pdf->Cell(35,8,'Nama',1,0,'C',true);
$pdf->Cell(50,8,'Email',1,0,'C',true);
$pdf->Cell(30,8,'Tanggal',1,0,'C',true);
$pdf->Cell(65,8,'Pesan Singkat',1,1,'C',true);

// Data dari database
$pdf->SetFont('Arial','',9);
$no = 1;
$query = mysqli_query($db, "SELECT * FROM tbl_kontak ORDER BY id_kontak DESC");
while($row = mysqli_fetch_assoc($query)) {
    $pesan = substr($row['pesan'], 0, 50) . (strlen($row['pesan']) > 50 ? '...' : '');
    $pdf->Cell(10,8,$no++,1);
    $pdf->Cell(35,8,$row['nama'],1);
    $pdf->Cell(50,8,$row['email'],1);
    $pdf->Cell(30,8,date('d-m-Y', strtotime($row['tanggal'])),1);
    $pdf->Cell(65,8,$pesan,1);
    $pdf->Ln();
}

// Footer tanda tangan
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(130);
$pdf->Cell(0,6,'Subang, '.date('d F Y'),0,1);
$pdf->Cell(130);
$pdf->Cell(0,6,'Mengetahui,',0,1);
$pdf->Cell(130);
$pdf->Cell(0,20,'Dosen Pembimbing',0,1);
$pdf->Cell(130);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,'(___________________)',0,1);

// Tampilkan PDF
$pdf->Output('I','laporan_kontak.pdf');
?>
