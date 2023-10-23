<?php
function obtenerDatosDesdeBaseDeDatos() {
    // Conexión a la base de datos (reemplaza con tus propios datos)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "datosdb";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Definir la consulta SQL
    $sql = "SELECT * FROM informacion";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si se obtuvieron resultados
    if ($result->num_rows > 0) {
        $registros = array();

        // Recorrer los resultados y almacenarlos en el arreglo
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }
    } else {
        echo "No se encontraron registros.";
    }

    // Cierra la conexión a la base de datos
    $conn->close();

    return $registros;
}

require 'vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear un nuevo libro de trabajo
$spreadsheet = new Spreadsheet();

// Crear una hoja
$sheet = $spreadsheet->getActiveSheet();

// Agregar datos a la hoja 
$sheet->setCellValue('A1', 'Nombre de Archivo');
$sheet->setCellValue('B1', 'Cantidad de Líneas');
$sheet->setCellValue('C1', 'Cantidad de Palabras');
$sheet->setCellValue('D1', 'Cantidad de Caracteres');
$sheet->setCellValue('E1', 'Fecha de registro');



// Obtener datos de la base de datos 
$registros = obtenerDatosDesdeBaseDeDatos();

// Llenar la hoja de cálculo con los registros
$row = 2;
foreach ($registros as $registro) {
    $sheet->setCellValue('A' . $row, $registro['nombrearchivo']);
    $sheet->setCellValue('B' . $row, $registro['cantlineas']);
    $sheet->setCellValue('C' . $row, $registro['cantpalabras']);
    $sheet->setCellValue('D' . $row, $registro['cantcaracteres']);
    $sheet->setCellValue('E' . $row, $registro['fecharegistro']);

    $row++;
}

// Crear un objeto de escritura y guardar el archivo
$writer = new Xlsx($spreadsheet);
$writer->save('informacion.xlsx'); // Cambia el nombre del archivo si lo deseas

// Descargar el archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="informacion.xlsx"');
header('Cache-Control: max-age=0');
readfile('informacion.xlsx');
