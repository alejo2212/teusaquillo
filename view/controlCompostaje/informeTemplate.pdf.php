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
    $this->Cell(120, 50, 'Informe De Control Compostaje', 0, 0, 'C');

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

  $id = controlCompostajeTableClass::ID ;
  $admin = controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR ;
  $veteri = controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO ;
  $respon = controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE;
  $fechare = controlCompostajeTableClass::FECHA_REALIZACION ;
  $cajon = controlCompostajeTableClass::CAJON_COMPOSTAJE_ID ;
  $galli = controlCompostajeTableClass::GALLINAZA_UTILIZADA;
  $canaves = controlCompostajeTableClass::CANTIDAD_TOTAL_AVES;
  $cantm = controlCompostajeTableClass::CANTIDAD_MACHOS;
  $canth = controlCompostajeTableClass::CANTIDAD_HEMBRAS;
  $lotesalida = controlCompostajeTableClass::SALIDA_LOTE_ID ;

$pdf = new PDF('L','mm','A4');// <- Formato para tamaño APAISADO
//$pdf = new PDF('P','mm','A4');// <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
//CABECERA DE LA TABLA: LONGITUD TOTAL 190 en tamaño normal y 275 en tamaño apaisado
$pdf->Cell(32, 5, 'Administrador', 1, 0, 'C');
$pdf->Cell(32, 5, 'Veterinario', 1, 0, 'C');
$pdf->Cell(34, 5, 'Responsable', 1, 0, 'C');
$pdf->Cell(37, 5, 'Fecha Realizacion', 1, 0, 'C');
$pdf->Cell(11, 5, 'Cajon', 1, 0, 'C');
$pdf->Cell(34, 5, 'Gallinaza Utilizada', 1, 0, 'C');
$pdf->Cell(22, 5, 'Cant Total', 1, 0, 'C');
$pdf->Cell(25, 5, 'Cant Machos', 1, 0, 'C');
$pdf->Cell(27, 5, 'Cant Hembras', 1, 0, 'C');
$pdf->Cell(26, 5, 'N.Salida Lote', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objcontrolCompostaje as $data):
  $pdf->Cell(32, 6, empleadoTableClass::getEmpleadoById($data->$admin), 1);
  $pdf->Cell(32, 6, empleadoTableClass::getEmpleadoById($data->$veteri), 1);
  $pdf->Cell(34, 6, empleadoTableClass::getEmpleadoById($data->$respon), 1);
  $pdf->Cell(37, 6, $data->$fechare, 1);
  $pdf->Cell(11, 6, $data->$cajon, 1);
  $pdf->Cell(34, 6, $data->$galli, 1);
  $pdf->Cell(22, 6, $data->$canaves, 1);
  $pdf->Cell(25, 6, $data->$cantm, 1);
  $pdf->Cell(27, 6, $data->$canth, 1);
  $pdf->Cell(26, 6, $data->$lotesalida, 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>