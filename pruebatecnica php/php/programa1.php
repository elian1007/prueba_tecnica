<?php
// Conexión a la base de datos


$servername = "localhost";
$username = "root";
$password = "";
$database = "datosdb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Procesar el archivo
$archivo = "archivo1.txt";  // Reemplaza con la ruta de tu archivo
$contenido = file_get_contents($archivo);
$lineas = count(file($archivo));
$palabras = str_word_count($contenido);
$caracteres = strlen($contenido);

// Insertar información en la base de datos
$nombreArchivo = "archivo1.txt";  // Reemplaza con el nombre del archivo
$insertSQL = "INSERT INTO informacion (nombrearchivo, cantlineas, cantpalabras, cantcaracteres, fecharegistro) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($insertSQL);
$stmt->bind_param("siii", $nombreArchivo, $lineas, $palabras, $caracteres);
$stmt->execute();

// Consultar registros de la base de datos
$consultaSQL = "SELECT * FROM informacion";
$result = $conn->query($consultaSQL);


// Obtén el código del registro desde la solicitud GET
if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // Consulta la base de datos para obtener los datos del registro
    $consultaSQL = "SELECT * FROM informacion WHERE codigo = ?";
    $stmt = $conn->prepare($consultaSQL);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

}
$conn->close();
?>
<header>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
</header>
  <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre de Archivo</th>
                <th scope="col">Cantidad de Líneas</th>
                <th scope="col">Cantidad de Palabras</th>
                <th scope="col">Cantidad de Caracteres</th>
                <th scope="col">registro</th>
                <th scope="col">Descargar PDF</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['nombrearchivo'] . '</td>';
                echo '<td>' . $row['cantlineas'] . '</td>';
                echo '<td>' . $row['cantpalabras'] . '</td>';
                echo '<td>' . $row['cantcaracteres'] . '</td>';
                echo '<td>' . $row['fecharegistro'] . '</td>';

                echo '<td><a href="generar_pdf.php?codigo=' . $row['codigo'] . '"><button type="button" class="btn btn-outline-danger">Descargar PDF</button>
                </a></td>';
                echo '<td><a href="generar_excel.php?codigo=' . $row['codigo'] . '"><button type="button" class="btn btn-outline-success">Descargar Excel</button></a></td>';

                echo '</tr>';
            }
            ?>
        </tbody>
    </table>