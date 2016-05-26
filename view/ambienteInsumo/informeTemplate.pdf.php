<?php

class PDF extends FPDF {

// Cabecera de página
  function Header() {

//    // Logo
//    $this->Image('logo_pb.png', 10, 8, 33);
    $this->Image(\mvc\routing\routingClass::getInstance()->getUrlImg('logo3.jpg'), 35, 8, 150);
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
    $this->Cell(30, 50, 'Informe de Ambiente Insumo', 0, 0, 'C');

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

$ambId = ambienteInsumoTableClass::AMBIENTE_ID;
$salidaInD = ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID;
$fechaA = ambienteInsumoTableClass::FECHA_ASIGNACION;
$fechaR = ambienteInsumoTableClass::FECHA_RETIRO;


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
//
// CABECERA DE LA TABLA  LONGITUD MAXIMA ES 190**********************
$pdf->Cell(47, 5, 'Ambiente ', 1, 0, 'C');
$pdf->Cell(47, 5, 'Numero Salida Insumo', 1, 0, 'C');
$pdf->Cell(47, 5, 'Fecha Asignacion', 1, 0, 'C');
$pdf->Cell(47, 5, 'Fecha Retiro', 1, 0, 'C');
// FIN CABECERA DE LA TABLA **********************
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objAmbienteInsumo as $data):
  $pdf->Cell(47, 6, ambientetableClass::getNombreById($data->$ambId), 1);
  $pdf->Cell(47, 6, $data->$salidaInD, 1);
  $pdf->Cell(47, 6, $data->$fechaA, 1);
  $pdf->Cell(47, 6, $data->$fechaR, 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>