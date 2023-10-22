<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "datosdb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

require('tcpdf/tcpdf.php');  // Asegúrate de incluir el archivo de la librería TCPDF

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // Consulta la base de datos para obtener los datos del registro
    $consultaSQL = "SELECT * FROM informacion WHERE codigo = ?";
    $stmt = $conn->prepare($consultaSQL);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Crear un nuevo PDF
    $pdf = new TCPDF();

    $pdf->AddPage();
    $pdf->SetFont('dejavusans', '', 12);

    // Agregar los datos del registro al PDF
    $pdf->Cell(0, 10, 'Nombre de Archivo: ' . $row['nombrearchivo'], 0, 1);
    $pdf->Cell(0, 10, 'Cantidad de Líneas: ' . $row['cantlineas'], 0, 1);
    $pdf->Cell(0, 10, 'Cantidad de Palabras: ' . $row['cantpalabras'], 0, 1);
    $pdf->Cell(0, 10, 'Cantidad de Caracteres: ' . $row['cantcaracteres'], 0, 1);
    $pdf->Cell(0, 10, 'Fecha de registro: ' . $row['fecharegistro'], 0, 1);


    // Generar el PDF y enviarlo al navegador para descarga
    $pdf->Output('informacion.pdf', 'D');
}
?>
