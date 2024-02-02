<?php
session_start();

if (!isset($_SESSION["login"])) {
   header("location: login.php");
   exit;
}
require "lib/fpdf184/fpdf.php";
require "functions.php";

$pdf = new FPDF("P", "mm", "A4");
$pdf->AddPage();

$pdf->SetFont("Times", "B", 10);
$pdf->Cell(200, 10, "Data Kendaraan", 0, 1, "C");

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(30, 7, 'Plat Nomor', 1, 0, 'C');
$pdf->Cell(40, 7, 'Waktu Masuk', 1, 0, 'C');
$pdf->Cell(40, 7, 'Waktu Keluar', 1, 0, 'C');
$pdf->Cell(30, 7, 'Merk', 1, 0, 'C');

$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;
$barang = query('SELECT * FROM k_keluar ORDER BY waktu_masuk ASC');
foreach($barang as $row){
   if ($row["merk"] == 1) {
      $namaMerk = "Yamaha";
   } elseif ($row["merk"] == 2) {
      $namaMerk = "Honda";
   } elseif ($row["merk"] == 3) {
      $namaMerk = "Kawasaki";
   } elseif ($row["merk"] == 4) {
      $namaMerk = "Suzuki";
   } else {
      $namaMerk = "Lainnya";
   }
   $pdf->Cell(10,6, $no++,1,0,'C');
   $pdf->Cell(30,6, $row['plat_no'],1,0);
   $pdf->Cell(40,6, $row['waktu_masuk'],1,0);  
   $pdf->Cell(40,6, $row['waktu_masuk'],1,0);
   $pdf->Cell(30,6, $namaMerk,1,1);
}
$pdf->Output();
// $pdf->Output("F","report/laporan.pdf");
?>