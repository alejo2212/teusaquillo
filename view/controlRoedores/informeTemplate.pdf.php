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
    $this->Cell(120, 50, 'Informe De Control Roedores', 0, 0, 'C');

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

 $id = controlRoedoresTableClass::ID ;
 $admin = controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR ;
 $veteri = controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO ;
 $respon = controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE ;
 $fechare = controlRoedoresTableClass::FECHA_REALIZACION ;
 $insumo = controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID ;
 $pellets = controlRoedoresTableClass::PELLETS;
 $bloques = controlRoedoresTableClass::BLOQUES;
 $eviconsu = controlRoedoresTableClass::EVIDENCIA_CONSUMO;
 $lugar = controlRoedoresTableClass::LUGAR;

$pdf = new PDF('L','mm','A4');// <- Formato para tamaño APAISADO
//$pdf = new PDF('P','mm','A4');// <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
//CABECERA DE LA TABLA: LONGITUD TOTAL 190 en tamaño normal y 275 en tamaño apaisado
$pdf->Cell(32, 5, 'Administrador', 1, 0, 'C');
$pdf->Cell(32, 5, 'Veterinario', 1, 0, 'C');
$pdf->Cell(32, 5, 'Responsable', 1, 0, 'C');
$pdf->Cell(38, 5, 'Fecha Realizacion', 1, 0, 'C');
$pdf->Cell(30, 5, 'Numero Salida', 1, 0, 'C');
$pdf->Cell(20, 5, 'Pellets', 1, 0, 'C');
$pdf->Cell(22, 5, 'Bloques', 1, 0, 'C');
$pdf->Cell(36, 5, 'Evidencia Consumo', 1, 0, 'C');
$pdf->Cell(28, 5, 'Lugar', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objcontrolRoedores as $data):
  $pdf->Cell(32, 6, empleadoTableClass::getEmpleadoById($data->$admin), 1);
  $pdf->Cell(32, 6, empleadoTableClass::getEmpleadoById($data->$veteri), 1);
  $pdf->Cell(32, 6, empleadoTableClass::getEmpleadoById($data->$respon), 1);
  $pdf->Cell(38, 6, $data->$fechare, 1);
  $pdf->Cell(30, 6, $data->$insumo, 1);
  $pdf->Cell(20, 6, $data->$pellets, 1);
  $pdf->Cell(22, 6, $data->$bloques, 1);
  $pdf->Cell(36, 6, ($data->$eviconsu) ? 'Si': 'No', 1);
  $pdf->Cell(28, 6, $data->$lugar, 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>