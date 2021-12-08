<?php
require('FPDF/fpdf.php');
include 'connect.php';

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../IMG/Logo.png',88.5,25,33);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Movernos a la derecha
    $this->Cell(56);
    // Título
    $this->Cell(80,10,'Reporte de Estudio Medico',1,0,'C');
    // Salto de línea
    $this->Ln(50);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$ssql_pdf = "SELECT * FROM datos_paciente WHERE atendido_e = 'desactivado' AND atendido_m = 'atendido';";
            $ssql_pdf_ejecutar = mysqli_query($mysqli, $ssql_pdf) or die('Error: ' . $mysqli_error($mysqli));
            $ssql_pdf_array = mysqli_fetch_array($ssql_pdf_ejecutar);

            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(70,10,utf8_decode('Información del Paciente'), 0, 1, 'C', 0);
            $pdf->Cell(40,10,utf8_decode('Nombre:'), 1, 0, 'C', 0);
            $pdf->Cell(55,10,utf8_decode($ssql_pdf_array['nombre_paciente']), 1, 0, 'C', 0);
            $pdf->Cell(40,10,utf8_decode('Apellido:'), 1, 0, 'C', 0);
            $pdf->Cell(55,10,utf8_decode($ssql_pdf_array['apellido_paciente']), 1, 1, 'C', 0);
            $pdf->Cell(30,10,utf8_decode('Cedula:'), 1, 0, 'C', 0);
            $pdf->Cell(160,10,utf8_decode($ssql_pdf_array['cedula_paciente']), 1, 1, 'C', 0);
            $pdf->Cell(60,10,utf8_decode('Correo Electrónico:'), 1, 0, 'C', 0);
            $pdf->Cell(130,10,utf8_decode($ssql_pdf_array['correo_paciente']), 1, 1, 'C', 0);
            $pdf->Cell(50,10,utf8_decode('Examen Medico:'), 1, 0, 'C', 0);
            $pdf->Cell(140,10,utf8_decode($ssql_pdf_array['solicitud_diagnostico']), 1, 1, 'C', 0);
            $pdf->Cell(50,10,utf8_decode(''), 0, 1, 'C', 0);

            $pdf->Cell(70,10,utf8_decode('Información del Enfermero'), 0, 1, 'C', 0);
            $pdf->Cell(40,10,utf8_decode('Nombre:'), 1, 0, 'C', 0);
            $pdf->Cell(55,10,utf8_decode($ssql_pdf_array['nombre_enfermero']), 1, 0, 'C', 0);
            $pdf->Cell(40,10,utf8_decode('Apellido:'), 1, 0, 'C', 0);
            $pdf->Cell(55,10,utf8_decode($ssql_pdf_array['apellido_atencion']), 1, 1, 'C', 0);
            $pdf->Cell(70,10,utf8_decode('Fecha de Atencion:'), 1, 0, 'C', 0);
            $pdf->Cell(120,10,utf8_decode(date('d/m/Y h:i:s a',strtotime($ssql_pdf_array['fecha_enfermero']))), 1, 1, 'C', 0);
            $pdf->Cell(50,10,utf8_decode(''), 0, 1, 'C', 0);

            $pdf->Cell(70,10,utf8_decode('Información del Medico'), 0, 1, 'C', 0);
            $pdf->Cell(40,10,utf8_decode('Nombre:'), 1, 0, 'C', 0);
            $pdf->Cell(55,10,utf8_decode($ssql_pdf_array['nombre_medico']), 1, 0, 'C', 0);
            $pdf->Cell(40,10,utf8_decode('Apellido:'), 1, 0, 'C', 0);
            $pdf->Cell(55,10,utf8_decode($ssql_pdf_array['apellido_medico']), 1, 1, 'C', 0);
            $pdf->Cell(70,10,utf8_decode('Fecha de Atencion:'), 1, 0, 'C', 0);
            $pdf->Cell(120,10,utf8_decode(date('d/m/Y h:i:s a',strtotime($ssql_pdf_array['fecha_diagnostico']))), 1, 1, 'C', 0);
            $pdf->Cell(50,60,utf8_decode(''), 0, 1, 'C', 0);

            $pdf->Cell(190,10,utf8_decode('Diagnostico:'), 1, 1, 'C', 0);
            $pdf->Cell(190,205,utf8_decode($ssql_pdf_array['resultado_diagnostico']), 1, 0, 'L', 0);
            
            $pdfdoc = $pdf->Output('','S');

            ?>