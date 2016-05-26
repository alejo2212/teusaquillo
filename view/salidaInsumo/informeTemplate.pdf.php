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
    $this->Cell(30, 50, 'Informe de Salida Insumo', 0, 0, 'C');

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


$id = salidaInsumoTableClass::ID; 
$empleSal = salidaInsumoTableClass::EMPLEADO_ID_SALIDA ;
$empleRec = salidaInsumoTableClass::EMPLEADO_ID_RECEPCION ;
$fecha = salidaInsumoTableClass::FECHA ;
$observacion = salidaInsumoTableClass::OBSERVACION ;
$anulado = salidaInsumoTableClass::ANULADO ;
$requisi = salidaInsumoTableClass::REQUISICION_ID ;



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
//
// CABECERA DE LA TABLA  LONGITUD MAXIMA ES 190**********************
$pdf->Cell(47, 5, 'Empleado Entrega', 1, 0, 'C');
$pdf->Cell(47, 5, 'Empleado Recibe', 1, 0, 'C');
$pdf->Cell(47, 5, 'Fecha', 1, 0, 'C');
//$pdf->Cell(38, 5, 'Anulado', 1, 0, 'C');
$pdf->Cell(47, 5, 'N. Requisicion', 1, 0, 'C');
// FIN CABECERA DE LA TABLA **********************
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objSalidainsumo as $data):
  $pdf->Cell(47, 6, empleadoTableClass::getEmpleadoById($data->$empleSal), 1);
  $pdf->Cell(47, 6, empleadoTableClass::getEmpleadoById($data->$empleRec), 1);
  $pdf->Cell(47, 6, $data->$fecha, 1);
//  $pdf->Cell(38, 6, $data->$anulado, 1);
  $pdf->Cell(47, 6, $data->$requisi, 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>


                                