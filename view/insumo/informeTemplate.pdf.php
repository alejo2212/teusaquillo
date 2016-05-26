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
$this->Cell(30, 50, 'Informe de los Insumos Existentes', 0, 0, 'C');

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


 $actived = insumoTableClass::ACTIVO;
 $nombre = insumoTableClass::NOMBRE;
 $tpinsumo = insumoTableClass::TIPO_INSUMO_ID; 
 $prinsumo = insumoTableClass::PRESENTACION_ID;
 $presen = insumoTableClass::UNIDAD_MEDIDA_ID; 
 $existencia = insumoTableClass::INVENTARIO_BODEGA;


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, ''); LIMITE DE CABECERA ES 190
$pdf->Cell(20, 5, 'Activo', 1, 0, 'C');
$pdf->Cell(36, 5, 'Nombre', 1, 0, 'C');
$pdf->Cell(32, 5, 'Tipo de Insumo', 1, 0, 'C');
$pdf->Cell(32, 5, 'Presentacion', 1, 0, 'C');
$pdf->Cell(32, 5, 'U/M', 1, 0, 'C');
$pdf->Cell(40, 5, 'Cantidad disponible', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objinsumo as $data):
$pdf->Cell(20, 6, ($data->$actived) ? 'Si' : 'No', 1);
$pdf->Cell(36, 6, $data->$nombre, 1);
$pdf->Cell(32, 6, tipoInsumoTableClass::getNombreById($data->$tpinsumo), 1);
$pdf->Cell(32, 6,presentacionTableClass::getNombreById($data->$prinsumo), 1);
$pdf->Cell(32, 6, unidadMedidaTableClass::getNombreById($data->$presen), 1);
$pdf->Cell(40, 6, $data->$existencia, 1);
$pdf->Ln();
endforeach;
$pdf->Output();
?>