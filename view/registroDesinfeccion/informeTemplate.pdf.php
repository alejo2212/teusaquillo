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
    $this->Cell(120, 50, 'Informe De Registro Desinfeccion', 0, 0, 'C');

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

$id = registroDesinfeccionTableClass::ID; 
$fechare = registroDesinfeccionTableClass::FECHA_REALIZACION; 
$fechater = registroDesinfeccionTableClass::FECHA_TERMINADO ;
$respon = registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE ;
$veri = registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR ;
$insumo = registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID ;
$solucion = registroDesinfeccionTableClass::SOLUCION ;
$tipdesin = registroDesinfeccionTableClass::TIPO_DESINFECCION_ID ;

$desBodega = registroDesinfeccionTableClass::DES_BODEGA;
$desPediluvios = registroDesinfeccionTableClass::DES_PEDILUVIOS;
$desRamadas = registroDesinfeccionTableClass::DES_RAMDAS;
$cantPediluvios = registroDesinfeccionTableClass::CANT_PEDILUVIOS;

$pdf = new PDF('L','mm','A4');// <- Formato para tamaño APAISADO
//$pdf = new PDF('P','mm','A4');// <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 10);
//$pdf->Cell(50, 5, '');
//CABECERA DE LA TABLA: LONGITUD TOTAL 190 en tamaño normal y 275 en tamaño apaisado
$pdf->Cell(33, 5, 'Fecha Realizacion', 1, 0, 'C');
//$pdf->Cell(33, 5, 'Fecha Terminado', 1, 0, 'C');
$pdf->Cell(30, 5, 'Responsable', 1, 0, 'C');
$pdf->Cell(30, 5, 'Verificador', 1, 0, 'C');
$pdf->Cell(30, 5, 'Insumo', 1, 0, 'C');
$pdf->Cell(48, 5, 'Solucion', 1, 0, 'C');
$pdf->Cell(26, 5, 'Desinfeccion', 1, 0, 'C');
$pdf->Cell(20, 5, 'Des. Bodega', 1, 0, 'C');
$pdf->Cell(35, 5, 'Des. Ambiente', 1, 0, 'C');
$pdf->Cell(25, 5, 'Des. Pediluvios', 1, 0, 'C');
//$pdf->Cell(25, 5, 'Cant. Pediluvios', 1, 0, 'C');

//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objregistroDesinfeccion as $data):
  $pdf->Cell(33, 6, $data->$fechare, 1);
//  $pdf->Cell(33, 6, $data->$fechater, 1);
  $pdf->Cell(30, 6, empleadoTableClass::getEmpleadoById($data->$respon), 1);
  $pdf->Cell(30, 6, empleadoTableClass::getEmpleadoById($data->$veri), 1);
  $pdf->Cell(30, 6, insumoTableClass::getNombreById($data->$insumo), 1);
  $pdf->Cell(48, 6, $data->$solucion, 1);
  $pdf->Cell(26, 6, tipoDesinfeccionTableClass::getNombreById($data->$tipdesin), 1);
  $pdf->Cell(20, 6, ($data->$desBodega) ? 'Si': 'No', 1);
  $pdf->Cell(35, 6, $data->$desRamadas, 1);
  $pdf->Cell(25, 6, ($data->$desPediluvios) ? 'Si - '.$data->$cantPediluvios: 'No', 1);
//  $pdf->Cell(25, 6, $data->$cantPediluvios, 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>