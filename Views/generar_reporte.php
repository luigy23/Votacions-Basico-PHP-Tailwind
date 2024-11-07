<?php
require('../fpdf/fpdf.php');
// Conexión a la base de datos
include_once '../conexion.php';
include_once '../Controller/Resultados.php';

$database = new Database();
$db = $database->getConnection();
$resultadoController = new ResultadoController($db);
$resultados = $resultadoController->getAll();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Resultados de las Votaciones', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla
$pdf->Cell(60, 10, 'Candidato', 1); //explicacion de los parametros: ancho, alto, texto, borde y  los valores están en milímetros
$pdf->Cell(60, 10, 'Partido', 1);
$pdf->Cell(30, 10, 'Votos', 1);
$pdf->Ln();

// Datos de la tabla
foreach ($resultados as $resultado) {
    $pdf->Cell(60, 10, $resultado['nombre'], 1);
    $pdf->Cell(60, 10, $resultado['partido'], 1);
    $pdf->Cell(30, 10, $resultado['votos'], 1);
    $pdf->Ln();
}

$pdf->Output();
?>