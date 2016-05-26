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
    $this->Cell(30, 50, 'Informe de Mortalidad', 0, 0, 'C');

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

 $id = salidaLoteTableClass::ID;
 $ambhislote = salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID; 
 $razonsal = salidaLoteTableClass::RAZON_SALIDA_ID; 
 $cantt = salidaLoteTableClass::CANTIDAD_TOTAL ;
 $cantm = salidaLoteTableClass::CANTIDAD_MACHOS ;
 $canth = salidaLoteTableClass::CANTIDAD_HEMBRAS ;
 $empl = salidaLoteTableClass::EMPLEADO_ID;
                        
//$pdf = new PDF('L', 'mm', 'A4'); // <- Formato para tamaño APAISADO
$pdf = new PDF('P', 'mm', 'A4'); // <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
//
// CABECERA DE LA TABLA  LONGITUD MAXIMA ES 190**********************
$pdf->Cell(36, 5, 'N. Ambi. Histor.', 1, 0, 'C');
$pdf->Cell(66, 5, 'Razon', 1, 0, 'C');
$pdf->Cell(46, 5, 'Cant. Total', 1, 0, 'C');
$pdf->Cell(46, 5, 'Cant. Machos', 1, 0, 'C');
$pdf->Cell(46, 5, 'Cant. Hembras', 1, 0, 'C');
$pdf->Cell(36, 5, 'Empleado', 1, 0, 'C');
// FIN CABECERA DE LA TABLA **********************
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objSalidalote as $data):
  $pdf->Cell(36, 6, $data->$ambhislote, 1);
  $pdf->Cell(66, 6, razonSalidatableClass::getNombreById($data->$razonsal), 1);
  $pdf->Cell(46, 6, ($data->$cantt), 1);
  $pdf->Cell(46, 6, ($data->$cantm), 1);
  $pdf->Cell(46, 6, ($data->$canth), 1);
  $pdf->Cell(36, 6, empleadotableClass::getEmpleadoById($data->$empl), 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>