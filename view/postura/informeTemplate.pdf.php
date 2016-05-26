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
    $this->Cell(30, 50, 'Informe de Postura', 0, 0, 'C');

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

use mvc\translator\translatorClass AS translator;

$idLote = loteTableClass::ID;
$idAmbi = ambienteBaseTableClass::ID;
$id = posturaTableClass::ID;
$lote = posturaTableClass::getNameField(posturaTableClass::LOTE_ID);
$ambi = posturaTableClass::AMBIENTE_ID;
$fecha = posturaTableClass::getNameField(posturaTableClass::FECHA);

//$pdf = new PDF('L', 'mm', 'A4'); // <- Formato para tamaño APAISADO
$pdf = new PDF('P', 'mm', 'A4'); // <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
foreach ($objPostura as $data):
  $fIni = $data[0];
endforeach;
$f = strtotime('+' . 1 . ' day', strtotime($fIni));
$nuevafecha = date('Y-m-d', $f);
$fFin = $nuevafecha;
$pdf->Cell(10, 5, '', 0, 0, 'C');
$pdf->Cell(30, 5, 'Lote #: ' . loteTableClass::getNombreById($olote), 0, 0, 'I');
$pdf->Cell(30, 5, '', 0, 0, 'C');
$pdf->Cell(30, 5, 'Raza : ' . razaTableClass::getNombreRazaByIdLote($olote), 0, 0, 'I');
$pdf->Cell(19, 5, '', 0, 0, 'C');
$pdf->Cell(30, 5, 'Fecha :' . translator::translateDate(date(' F (j ', strtotime($fIni))) . '-' . translator::translateDate(date(' j) \d\e Y ', strtotime($obfecha[1]))), 0, 0, 'I');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(10, 5, '', 0, 0, 'C');
$pdf->Cell(30, 5, 'Fecha / Dia', 1, 0, 'C');
$pdf->Cell(30, 5, 'Postura', 1, 0, 'C');
$pdf->Cell(30, 5, 'Incubacion', 1, 0, 'C');
$pdf->Cell(30, 5, 'Consumo', 1, 0, 'C');
$pdf->Cell(50, 5, 'Despachos Incubadora', 1, 0, 'C');
//$pdf->Cell(20, 5, 'Ambiente', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
$tpostu = 0;
$tincu = 0;
$tconsu = 0;
//exit();
$newLeng = strlen($obfecha[1]);
$obfecha = substr($obfecha[1], $newLeng - 2, $newLeng);
for ($i = 0; $i < $obfecha; $i++) {
  $datos = posturaTableClass::getPostuIncuConsu($fIni, $fFin, $olote);
  foreach ($datos as $da):
    $pdf->Cell(10, 6, '', 0, 0, 'C');
    $pdf->Cell(30, 6, $fIni, 1);
    $pdf->Cell(30, 6, ($da->postura), 1);
    $pdf->Cell(30, 6, ($da->incubacion), 1);
    $pdf->Cell(30, 6, ($da->consumo), 1);
    $pdf->Cell(50, 6, '', 1);
    $tpostu = $tpostu + ($da->postura);
    $tincu = $tincu + ($da->incubacion);
    $tconsu = $tconsu + ($da->consumo);
  endforeach;
  $pdf->Ln();
  $f = strtotime('+' . 1 . ' day', strtotime($fIni));
  $fIni = date('Y-m-d', $f);

  $ff = strtotime('+' . 1 . ' day', strtotime($fFin));
  $fFin = date('Y-m-d', $ff);
}
//if ($tpostu != 0) {
  $pdf->SetTextColor(250, 50, 50);
  $pdf->SetFont('Arial', 'B', 15);
  $pdf->Cell(10, 6, '', 0, 0, 'C');
  $pdf->Cell(30, 7, 'TOTAL', 1);
  $pdf->Cell(30, 7, $tpostu, 1);
  $pdf->Cell(30, 7, $tincu, 1);
  $pdf->Cell(30, 7, $tconsu, 1);
//}
$pdf->Cell(50, 7, '', 1);
//$pdf->SetFont('Arial', 'C', 15);
$pdf->SetTextColor(0, 0, 0);
$pdf->Output();
?>



