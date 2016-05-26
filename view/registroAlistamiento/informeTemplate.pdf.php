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
    $this->Cell(120, 50, 'Informe de Alistamiento Galpon', 0, 0, 'C');

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

$id = registroAlistamientoTableClass::ID;
$empleado = registroAlistamientoTableClass::EMPLEADO_ID;
$lote = registroAlistamientoTableClass::LOTE_ID;
$salida = registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID;
$fecha_ini = registroAlistamientoTableClass::FECHA_INICIO;
$fecha_fin = registroAlistamientoTableClass::FECHA_FIN;
$fecha_ini_cortina = registroAlistamientoTableClass::FECHA_INICIO_CORTINA;
$fecha_fin_cortina = registroAlistamientoTableClass::FECHA_FIN_CORTINA;
$fecha_ini_cama = registroAlistamientoTableClass::FECHA_ENTRADA_CAMA;
$fecha_fin_cama = registroAlistamientoTableClass::FECHA_TERMINO_CAMA;
$fecha_equipo = registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO;

$pdf = new PDF('L', 'mm', 'A4'); // <- Formato para tamaño APAISADO
//$pdf = new PDF('P','mm','A4');// <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 9);
//$pdf->Cell(50, 5, '');
$pdf->Cell(37, 5, 'Empleado', 1, 0, 'C');
$pdf->Cell(16, 5, 'Salida', 1, 0, 'C');
$pdf->Cell(8, 5, 'Lote', 1, 0, 'C');
$pdf->Cell(28, 5, 'Fecha Inicio', 1, 0, 'C');
$pdf->Cell(28, 5, 'Fecha Fin', 1, 0, 'C');
$pdf->Cell(32, 5, 'Fecha Inico Cortina', 1, 0, 'C');
$pdf->Cell(37, 5, 'Fecha Finalizacion Cortina', 1, 0, 'C');
$pdf->Cell(29, 5, 'Fecha Inico Cama', 1, 0, 'C');
$pdf->Cell(32, 5, 'Fecha Finalizacion Cama', 1, 0, 'C');
$pdf->Cell(30, 5, 'Fecha Entrada Equipo', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objregistroAlistamiento as $data):
  $pdf->Cell(37, 6, empleadoTableClass::getEmpleadoById($data->$empleado), 1);
  $pdf->Cell(16, 6, $data->$salida, 1);
  $pdf->Cell(8, 6, loteTableClass::getLote($data->$lote), 1);
  $pdf->Cell(28, 6, $data->$fecha_ini, 1);
  $pdf->Cell(28, 6, $data->$fecha_fin, 1);
  $pdf->Cell(32, 6, $data->$fecha_ini_cortina, 1);
  $pdf->Cell(37, 6, $data->$fecha_fin_cortina, 1);
  $pdf->Cell(29, 6, $data->$fecha_ini_cama, 1);
  $pdf->Cell(32, 6, $data->$fecha_fin_cama, 1);
  $pdf->Cell(30, 6, $data->$fecha_equipo, 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>