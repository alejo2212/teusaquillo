<?php

class PDF extends FPDF {

// Cabecera de página
  function Header() {

//    // Logo
//    $this->Image('logo_pb.png', 10, 8, 33);
    $this->Image(\mvc\routing\routingClass::getInstance()->getUrlImg('logo3.jpg'), 80, 8, 150);
//    $this->Image(\mvc\routing\routingClass::getInstance()->getUrlWeb('img',\mvc\routing\routingClass::getInstance()->getUrlImg('logo_pb.png')), 10, 8, 20);
//    // Arial bold 15
    $this->SetFont('Arial', 'U', 15);
//    // Movernos a la derecha
    $this->Cell(150);
//    // Título
//$this->Cell(30, 10, 'Avicola Teusaquillo', 0, 0, 'C');
//    // Salto de línea
    $this->Ln(5);
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(80);
//    // Título
    $this->Cell(120, 50, 'Informe de los Lotes', 0, 0, 'C');

//    // Salto de línea
    $this->Ln(40);
  }

// Pie de página
  function Footer() {
// Posición: a 1,5 cm del final
    $this->SetY(-15);
// Arial italic 8
    $this->SetFont('Arial', 'I', 8);
// Número de página
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }

}

$id = loteTableClass::ID;
$nlote = loteTableClass::LOTE;
$fEntradaG = loteTableClass::FECHA_ENTRADA_GRANJA;
$fSalidaR = loteTableClass::FECHA_SALIDA_REAL;
$razaId = loteTableClass::RAZA_ID;
$cantM = loteTableClass::CANTIDAD_MACHOS;
$cantH = loteTableClass::CANTIDAD_HEMBRAS;
$cantT = loteTableClass::CANTIDAD_TOTAL;



$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
//
// CABECERA DE LA TABLA  LONGITUD MAXIMA ES 190 - TABLA HORIZONTAL 275 LONGITUD**********************

$pdf->Cell(19, 5, 'N. Lote', 1, 0, 'C');
$pdf->Cell(59, 5, 'Fecha Entra Granj', 1, 0, 'C');
$pdf->Cell(59, 5, 'Fecha Salida Real', 1, 0, 'C');
$pdf->Cell(19, 5, 'Raza', 1, 0, 'C');
$pdf->Cell(39, 5, 'Cant. Machos.', 1, 0, 'C');
$pdf->Cell(39, 5, 'Cant. Hembras.', 1, 0, 'C');
$pdf->Cell(39, 5, 'Cant. Total', 1, 0, 'C');

// FIN CABECERA DE LA TABLA **********************
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objLote as $data):
  $pdf->Cell(19, 6, $data->$nlote, 1);
  $pdf->Cell(59, 6, $data->$fEntradaG, 1);
  $pdf->Cell(59, 6, $data->$fSalidaR, 1);
  $pdf->Cell(19, 6, razatableClass::getNombreById($data->$razaId), 1);
  $pdf->Cell(39, 6, $data->$cantM, 1);
  $pdf->Cell(39, 6, $data->$cantH, 1);
  $pdf->Cell(39, 6, $data->$cantT, 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>