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
$this->Cell(30, 50, 'Informe de Ambiente Historial Lote', 0, 0, 'C');

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



$ambiente = ambienteHistorialLoteTableClass::AMBIENTE_ID;
$lote = ambienteHistorialLoteTableClass::LOTE_ID;
$numerocaseta = ambienteHistorialLoteTableClass::NO_CASETA;
$canth = ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS;
$cantm = ambienteHistorialLoteTableClass::CANTIDAD_MACHOS;


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, ''); LIMITE DE CABECERA ES 190
$pdf->Cell(39, 5, 'Ambiente', 1, 0, 'C');
$pdf->Cell(39, 5, 'Numero Lote', 1, 0, 'C');
$pdf->Cell(39, 5, 'Numero de Caseta', 1, 0, 'C');
$pdf->Cell(39, 5, 'Cantidad Hembras', 1, 0, 'C');
$pdf->Cell(39, 5, 'Cantidad Machos', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objambienteHistorialLote as $data):
$pdf->Cell(39, 6, ambienteTableClass::getNombreById($data->$ambiente), 1);
$pdf->Cell(39, 6, loteTableClass::getNombreById($data->$lote), 1);
$pdf->Cell(39, 6, $data->$numerocaseta, 1);
$pdf->Cell(39, 6, $data->$canth, 1);
$pdf->Cell(39, 6, $data->$cantm, 1);
$pdf->Ln();
endforeach;
$pdf->Output();
?>