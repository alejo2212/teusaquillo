<?php
class PDF extends FPDF {

// Cabecera de página
function Header() {
    
//    // Logo
//    $this->Image('logo_pb.png', 10, 8, 33);
    $this->Image(\mvc\routing\routingClass::getInstance()->getUrlImg('logo3.jpg'), 35, 8,150);
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
$this->Cell(30, 50, 'Informe de Entradas de Bodega', 0, 0, 'C');

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



$empleado = entradaBodegaTableClass::EMPLEADO_ID;
$transportador = entradaBodegaTableClass::TRANSPORTADOR_ID; 
$fechaentrada = entradaBodegaTableClass::FECHA_ENTRADA; 
$remision = entradaBodegaTableClass::REMISION;


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, ''); LIMITE DE CABECERA ES 190
$pdf->Cell(48, 5, 'Empleado', 1, 0, 'C');
$pdf->Cell(48, 5, 'Transportador', 1, 0, 'C');
$pdf->Cell(48, 5, 'Fecha de entrada', 1, 0, 'C');
$pdf->Cell(48, 5, 'Remision', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objentradaBodega as $data):
$pdf->Cell(48, 6, empleadoTableClass::getEmpleadoById($data->$empleado), 1);
$pdf->Cell(48, 6, transportadorTableClass::getNombreById($data->$transportador), 1);
$pdf->Cell(48, 6, $data->$fechaentrada, 1);
$pdf->Cell(48, 6, $data->$remision, 1);
$pdf->Ln();
endforeach;
$pdf->Output();
?>