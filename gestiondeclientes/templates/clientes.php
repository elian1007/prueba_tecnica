
<?php
 include 'layout/menu.html';
 $host = 'localhost';
 $dbname = 'gestióndeclientesdb';
 $username = 'userroot';
 $password = '2536';
 
 try {
     $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        // Manejo de errores de conexión
        echo "Error de conexión: " . $e->getMessage();
    }
    

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $tipo_identificacion = $_POST["tipo_identificacion"];
     $numero_cliente = $_POST["numero_cliente"];
     $nombre = $_POST["nombre"];
     $telefono = $_POST["telefono"];
     $ciudad = $_POST["ciudad"];
     $correo = $_POST["correo"];
 
     // Validar los datos ingresados 
     $tipo_identificacion = $_POST["tipo_identificacion"] ?? ''; // Si no existe, se asigna una cadena vacía
     $numero_cliente = $_POST["numero_cliente"] ?? ''; // Si no existe, se asigna una cadena vacía
     $nombre = $_POST["nombre"] ?? ''; // Si no existe, se asigna una cadena vacía
     $telefono = $_POST["telefono"] ?? ''; // Si no existe, se asigna una cadena vacía
     $ciudad = $_POST["ciudad"] ?? ''; // Si no existe, se asigna una cadena vacía
     $correo = $_POST["correo"] ?? ''; // Si no existe, se asigna una cadena vacía

 
     // Insertar el nuevo cliente en la base de datos
     $sql = "INSERT INTO Clientes (tipo_identificacion, numero_cliente, nombre, telefono, ciudad, correo) 
             VALUES (:tipo_identificacion, :numero_cliente, :nombre, :telefono, :ciudad, :correo)";
     $stmt = $conn->prepare($sql);
     $stmt->bindParam(":tipo_identificacion", $tipo_identificacion);
     $stmt->bindParam(":numero_cliente", $numero_cliente);
     $stmt->bindParam(":nombre", $nombre);
     $stmt->bindParam(":telefono", $telefono);
     $stmt->bindParam(":ciudad", $ciudad);
     $stmt->bindParam(":correo", $correo);
     $stmt->execute();
 
     echo '<script>alert("Acción completada con éxito.");</script>';



     $conn = null;
 }
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación de Gestión</title>
    <link rel="stylesheet" type="text/css" href="script/css/clientes.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container flex-grow-1 px-5 pt-2">
    <div class="d-flex py-2 justify-content-between mb-3">
        <h4 class="text-gray fw-bold p-0 m-0">Gestión de clientes</h4>
    </div>

    <div class="row">

        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header bg-white d-flex flex-row align-items-center justify-content-between py-3">
                    <h6 class="card-title m-0 fw-bold">Formulario de clientes</h6>
                </div>
                <form action="clientes.php" method="post" class="needs-validation" id="form-company">
               
                    <div class="card-body d-flex flex-column">
                        <div class="row mb-3">
                         
                            <div class="col-md-6 form-group my-2">
                                <label for="codigo" class="form-label">Tipo de identidad<span
                                    class="text-danger">*</span></label>
                                <input type="text" placeholder="Tipo de identidad" name="tipo_identificacion" class="form-control" id="tipo_identificacion" value="" required>
                            </div>
                            <div class="col-md-6 form-group my-2">
                                <label for="codigo" class="form-label">Numero de cliente<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="numero_cliente" placeholder="Ingrese en numero de cliente" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-6 form-group my-2">
                                <label for="codigo" class="form-label">Nombre<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="nombre" placeholder="Ingrese el nombre" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-6 form-group my-2">
                                <label for="codigo" class="form-label">Telefono<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="telefono" placeholder="Ingrese el telefono" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-6 form-group my-2">
                                <label for="codigo" class="form-label">Ciudad<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="ciudad" placeholder="Ingrese la ciudad" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-6 form-group my-2">
                                <label for="codigo" class="form-label">Correo<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="correo" placeholder="Ingrese el correo" class="form-control" id="code" value="" required>
                            </div>



                        </div>
                        <div class="d-flex align-self-end">
                            <button id="btn-save" type="submit" class="btn btn-success flex-grow-0 mt-3 ">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card flex-grow-1">
                <div class="card-header bg-white d-flex flex-row align-items-center justify-content-between py-3">
                    <h6 class="card-title m-0  fw-bold">Listado de clientes</h6>
                </div>
                <div class="card-body ">
                <table class="table">
  <thead>
    <tr>
      <th scope="col">Tipo de identificaciòn</th>
      <th scope="col">Número de cliente</th>
      <th scope="col">Nombre</th>
      <th scope="col">Telefono</th>
      <th scope="col">Ciudad</th>
      <th scope="col">Correo</th>

    </tr>
  </thead>

        </div>
            </div>
        </div>

    </div>
</div>

  <?php
   $host = 'localhost';
   $dbname = 'gestióndeclientesdb';
   $username = 'userroot';
   $password = '2536';
   try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

    echo '<script>alert("Base de datos conectada con exito.");</script>';

if ($conn) {
} else {
    echo "Error de conexión a la base de datos.";
}

$query = "SELECT * FROM clientes";
?>


  <?php
try {
    $result = $conn->query($query);
    
    if ($result) {
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['tipo_identificacion'] . "</td>";
            echo "<td>" . $row['numero_cliente'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['telefono'] . "</td>";
            echo "<td>" . $row['ciudad'] . "</td>";
            echo "<td>" . $row['correo'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se pudo obtener los datos de la base de datos.";
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
    ?>
    



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="validaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
