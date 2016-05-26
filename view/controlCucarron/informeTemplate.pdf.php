<?php

$id = controlCucarronTableClass::ID;
$admin = controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR;
$veteri = controlCucarronTableClass::EMPLEADO_ID_VETERINARIO;
$respon = controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE;
$fechare = controlCucarronTableClass::FECHA_REALIZACION;
$insumo = controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID;
$solucion = controlCucarronTableClass::SOLUCION;
$formapli = controlCucarronTableClass::FORMA_APLICACION_ID;
$aretrata = controlCucarronTableClass::AREA_TRATADA;
foreach ($objcontrolCucarron as $data):
  $ad=$data->$admin;
endforeach;
class PDF extends FPDF {

  var $ad;

// Cabecera de página
  function Header() {
//     foreach ($objcontrolCucarron as $data):
    $this->ad = controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR;
//     endforeach;
//    // Logo
//    $this->Image('logo_pb.png', 10, 8, 33);
    $this->Image(\mvc\routing\routingClass::getInstance()->getUrlImg('logo3.jpg'), 80, 8, 150);

//    $this->Image(\mvc\routing\routingClass::getInstance()->getUrlWeb('img',\mvc\routing\routingClass::getInstance()->getUrlImg('logo_pb.png')), 10, 8, 20);
//    // Arial bold 15
    $this->SetFont('Arial', 'U', 10);
//    $this->Cell(350, 10, 'Administrador: ', 0, 0, 'C');
//    $this->Ln(0);
//    $this->Cell(450, 10, $this->ad = controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, 0, 0, 'C');
//    $this->Ln(5);
//    $this->Cell(344, 10, 'Veterinario:', 0, 0, 'C');
//    $this->Ln(0);
//    $this->Cell(450, 10, $this->ad = controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, 0, 0, 'C');
//    // Movernos a la derecha
    $this->Cell(150);
//    // Título
//$this->Cell(30, 10, 'Avicola Teusaquillo', 0, 0, 'C');
//    // Salto de línea
    $this->Ln(5);
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(80);
//    // Título
    $this->Cell(120, 50, 'Informe De Control Cucarron', 0, 0, 'C');

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

$pdf = new PDF('L', 'mm', 'A4'); // <- Formato para tamaño APAISADO
//$pdf = new PDF('P','mm','A4');// <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
//CABECERA DE LA TABLA: LONGITUD TOTAL 190 en tamaño normal y 275 en tamaño apaisado
$pdf->Cell(34, 5, 'Administrador', 1, 0, 'C');
$pdf->Cell(34, 5, 'Veterinario', 1, 0, 'C');
$pdf->Cell(34, 5, 'Responsable', 1, 0, 'C');
$pdf->Cell(44, 5, 'Fecha De Realizacion', 1, 0, 'C');
$pdf->Cell(34, 5, 'Numero Salida', 1, 0, 'C');
$pdf->Cell(24, 5, 'Solucion', 1, 0, 'C');
$pdf->Cell(44, 5, 'Forma De Aplicacion', 1, 0, 'C');
$pdf->Cell(24, 5, 'Area Tratada', 1, 0, 'C');



//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objcontrolCucarron as $data):
  $pdf->Cell(34, 6, empleadoTableClass::getEmpleadoById($data->$admin), 1);
  $pdf->Cell(34, 6, empleadoTableClass::getEmpleadoById($data->$veteri), 1);
  $pdf->Cell(34, 6, empleadoTableClass::getEmpleadoById($data->$respon), 1);
  $pdf->Cell(44, 6, $data->$fechare, 1);
  $pdf->Cell(34, 6, $data->$insumo, 1);
  $pdf->Cell(24, 6, $data->$solucion, 1);
  $pdf->Cell(44, 6, formaAplicacionTableClass::getNombreById($data->$formapli), 1);
  $pdf->Cell(24, 6, $data->$aretrata, 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>