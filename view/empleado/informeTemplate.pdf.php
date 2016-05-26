<?php

class PDF extends FPDF {

// Cabecera de página
  function Header() {
//    // Logo
//    $this->Image('logo_pb.png', 10, 8, 33);
    $this->Image(\mvc\routing\routingClass::getInstance()->getUrlImg('logo3.jpg'), 35, 8,150);

//    // Arial bold 15
    $this->SetFont('Arial', 'U', 15);
//    // Movernos a la derecha
    $this->Cell(150);
//    // Título

//    // Salto de línea
    $this->Ln(5);
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(80);
//    // Título
    $this->Cell(30, 50, 'Informe de Empleados', 0, 0, 'C');

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

$id = empleadoTableClass::DOCUMENTO;
$nombre = empleadoTableClass::NOMBRE;
$apellido = empleadoTableClass::APELLIDO;
$tel = empleadoTableClass::TELEFONO;
$cargo = empleadoTableClass::CARGO;
$activo = empleadoTableClass::ACTIVO;

//$pdf = new PDF('L','mm','A4');// <- Formato para tamaño APAISADO
$pdf = new PDF('P','mm','A4');// <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
$pdf->Cell(32, 5, 'Documento', 1, 0, 'C');
$pdf->Cell(32, 5, 'Nombre', 1, 0, 'C');
$pdf->Cell(32, 5, 'Apellido', 1, 0, 'C');
$pdf->Cell(32, 5, 'Telefono', 1, 0, 'C');
$pdf->Cell(32, 5, 'Cargo', 1, 0, 'C');
$pdf->Cell(32, 5, 'Activo', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objEmpleado as $data):
  $pdf->Cell(32, 6, $data->$id, 1);
  $pdf->Cell(32, 6, $data->$nombre, 1);
  $pdf->Cell(32, 6, $data->$apellido, 1);
  $pdf->Cell(32, 6, $data->$tel, 1);
  $pdf->Cell(32, 6, cargoTableClass::getCargoById($data->$cargo), 1);
  $pdf->Cell(32, 6, ($data->$activo) ? 'Si' : 'No', 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>