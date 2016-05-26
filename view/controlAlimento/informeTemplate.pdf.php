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
    $this->Cell(120, 50, 'Informe de Control de Alimento', 0, 0, 'C');

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

$idEmp = empleadoTableClass::ID;
$nombreEmp = empleadoTableClass::NOMBRE;
$id = controlAlimentoTableClass::ID;
$ahl = controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID;
$salida = controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID;
$emple = controlAlimentoTableClass::ID_EMPLEADO;
$sexo = controlAlimentoTableClass::SEXO;
$cantidad = controlAlimentoTableClass::CANTIDAD;
$fecha = controlAlimentoTableClass::FECHA;
$semana = controlAlimentoTableClass::SEMANA;
$obser = controlAlimentoTableClass::OBSERVACION;

$idAhl = ambienteHistorialLoteTableClass::ID;
$casetaAhl = ambienteHistorialLoteTableClass::NO_CASETA;
$nomAmbi = ambienteTableClass::NOMBRE;
$lote = loteTableClass::LOTE;

$pdf = new PDF('L', 'mm', 'A4'); // <- Formato para tamaño APAISADO
//$pdf = new PDF('P','mm','A4');// <- Formato para tamaño NORMAL
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
//$pdf->Cell(50, 5, '');
$pdf->Cell(55, 5, 'Ambiente', 1, 0, 'C');
$pdf->Cell(30, 5, 'Salida de Insumo', 1, 0, 'C');
$pdf->Cell(40, 5, 'Empleado', 1, 0, 'C');
$pdf->Cell(20, 5, 'Sexo', 1, 0, 'C');
$pdf->Cell(20, 5, 'Cantidad', 1, 0, 'C');
$pdf->Cell(39, 5, 'Fecha', 1, 0, 'C');
$pdf->Cell(20, 5, 'Semana', 1, 0, 'C');
$pdf->Cell(55, 5, 'Observacion', 1, 0, 'C');
//$pdf->Cell(50, 5, '');
$pdf->Ln();
foreach ($objControlAlimento as $data):
$ambi = ambienteHistorialLoteTableClass::getAmbienteHistLoteById($data->$ahl);
$pdf->Cell(55, 6, $ambi->$nomAmbi . ' - Lote:' . $ambi->$lote . ' - Caseta:' . $ambi->$casetaAhl, 1);
$pdf->Cell(30, 6, $data->$salida, 1);
$pdf->Cell(40, 6, empleadoTableClass::getEmpleadoById($data->$emple), 1);
$pdf->Cell(20, 6, ($data->$sexo) ? 'Masculino' : 'Femenino', 1);
$pdf->Cell(20, 6, $data->$cantidad, 1);
$pdf->Cell(39, 6, $data->$fecha, 1);
$pdf->Cell(20, 6, $data->$semana, 1);
$pdf->Cell(55, 6, $data->$obser, 1);
$pdf->Ln();
endforeach;
$pdf->Output();
?>