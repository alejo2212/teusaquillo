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
    $this->Cell(120, 50, 'Informe de Maquina', 0, 0, 'C');

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

$idclasima = clasificacionMaquinaTableClass::ID;
$nombreclasima = clasificacionMaquinaTableClass::DESCRIPCION;
$id = maquinaTableClass::ID;
$clasimaquiid = maquinaTableClass::CLASIFICACION_MAQUINA_ID;
$fechaIngre = maquinaTableClass::FECHA_INGRESO;
$descrip = maquinaTableClass::DESCRIPCION;
$codigo = maquinaTableClass::CODIGO;
$referencia = maquinaTableClass::REFERENCIA;
$fechaMante = maquinaTableClass::FECHA_MANTENIMIENTO;
$intervaloMante = maquinaTableClass::INTERVALO_MANTENIMIENTO;
$activo = maquinaTableClass::ACTIVADO;
$valor = maquinaTableClass::VALOR;

$pdf = new PDF('L', 'mm', 'A4'); // <- Formato para tamaño APAISADO
//$pdf = new PDF('P','mm','A4');// <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
$pdf->Cell(34, 5, 'Clasificacion', 1, 0, 'C');
$pdf->Cell(39, 5, 'Fecha de Ingreso', 1, 0, 'C');
$pdf->Cell(44, 5, 'Descripcion', 1, 0, 'C');
$pdf->Cell(34, 5, 'Codigo', 1, 0, 'C');
$pdf->Cell(34, 5, 'Referencia', 1, 0, 'C');
$pdf->Cell(39, 5, 'Fecha Mantenimiento', 1, 0, 'C');
$pdf->Cell(24, 5, 'Activado', 1, 0, 'C');
$pdf->Cell(24, 5, 'Valor', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objMaquina as $data):
  $pdf->Cell(34, 6, clasificacionMaquinaTableClass::getClasiMaquinaById($data->$idclasima), 1);
  $pdf->Cell(39, 6, $data->$fechaIngre, 1);
  $pdf->Cell(44, 6, $data->$descrip, 1);
  $pdf->Cell(34, 6, $data->$codigo, 1);
  $pdf->Cell(34, 6, $data->$referencia, 1);
  $pdf->Cell(39, 6, $data->$fechaMante, 1);
  $pdf->Cell(24, 6, ($data->$activo) ? 'Si' : 'No', 1);
  $pdf->Cell(24, 6, $data->$valor, 1);
  $pdf->Ln();
endforeach;
$pdf->Output();
?>