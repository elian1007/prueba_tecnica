<?php
// archivo.php
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
// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_contrato = $_POST["codigo_contrato"];
    $numero_cliente = $_POST["numero_cliente"];

    $numero_linea = $_POST["numero_linea"];
    $fecha_activacion = $_POST["fecha_activacion"];
    $valor_plan = $_POST["valor_plan"];
    $estado = $_POST["estado"];
    
    // Validar los datos (realizar validaciones aquí)

    // Conectar a la base de datos y realizar la operación de inserción

    // Insertar el contrato asociado al cliente
    $sql = "INSERT INTO Contratos (codigo_contrato, numero_cliente, numero_linea, fecha_activacion, valor_plan, estado) 
            VALUES (:codigo_contrato, :numero_cliente, :numero_linea, :fecha_activacion, :valor_plan, :estado)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":codigo_contrato", $codigo_contrato);
    $stmt->bindParam(":numero_cliente", $numero_cliente);


    $stmt->bindParam(":numero_linea", $numero_linea);
    $stmt->bindParam(":fecha_activacion", $fecha_activacion);
    $stmt->bindParam(":valor_plan", $valor_plan);
    $stmt->bindParam(":estado", $estado);
    $stmt->execute();


    echo '<script>alert("Acción completada con éxito.");</script>';


    // Cerrar la conexión a la base de datos
    $conn = null;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación de Gestión</title>
    <link rel="stylesheet" href="../script/css/clientes.css">
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

        <div class="col-md-12 mb-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-row align-items-center justify-content-between py-3">
                    <h6 class="card-title m-0 fw-bold">Formulario de contrato</h6>
                </div>
                <form action="contratos.php" method="post" class="needs-validation" id="form-company">
               
                    <div class="card-body d-flex flex-column">
                        <div class="row mb-3">
                         
                            <div class="col-md-12 form-group my-2">
                                <label for="codigo" class="form-label">Código contrato<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="codigo_contrato" placeholder="Código contrato" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-12 form-group my-2">
                            <label for="numero_cliente">Seleccionar Cliente Existente:</label>
        <select name="numero_cliente" id="numero_cliente">
            <option value="">Seleccionar cliente existente</option>
            <?php

            // Conexión a la base de datos
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);

            // Consulta para obtener la lista de clientes
            $query = "SELECT numero_cliente, nombre FROM clientes";
            $stmt = $conn->query($query);
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=\"" . $row['numero_cliente'] . "\">" . $row['numero_cliente'] . "</option>";
            }
            ?>
        </select>
                            </div>
                            <!-- <div class="col-md-12 form-group my-2">
                                <label for="codigo" class="form-label">Numero de cliente<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="numero_cliene" placeholder="Número de cliente" class="form-control" id="code" value="" >
                            </div> -->
                            <div class="col-md-12 form-group my-2">
                                <label for="codigo" class="form-label"># de línea<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="numero_linea" placeholder="# de línea" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-12 form-group my-2">
                                <label for="codigo" class="form-label">Fecha activación<span
                                    class="text-danger">*</span></label>
                                <input type="Date" name="fecha_activacion" placeholder="Fecha activación" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-12 form-group my-2">
                                <label for="codigo" class="form-label">Valor plan<span
                                    class="text-danger">*</span></label>
                                <input type="text" placeholder="Valor plan" name="valor_plan" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-12 form-group my-2">
                            <label for="cliente_existente">Estado:</label>
                            <select name="estado" id="estado">
                            <option ></option>
                            <option value="true">Activo</option>
                            <option value="false">Inactivo</option>
                            </select>
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
                    <h6 class="card-title m-0 fw-bold">Listado de contrato</h6>
                </div>
                <div class="card-body">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Código contrato</th>
      <th scope="col">Número de cliente</th>
      <th scope="col"># de línea</th>
      <th scope="col">Fecha activación</th>
      <th scope="col">Valor plan</th>
      <th scope="col">Estado</th>

    </tr>
  </thead>
  <tbody>
  <?php
        // Conexión a la base de datos y consulta de contratos

        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $query = "SELECT codigo_contrato, numero_cliente, numero_linea, fecha_activacion, valor_plan, estado FROM contratos";
        $stmt = $conn->query($query);

        // Mostrar los contratos en la tabla
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['codigo_contrato'] . "</td>";
            echo "<td>" . $row['numero_cliente'] . "</td>";
            echo "<td>" . $row['numero_linea'] . "</td>";
            echo "<td>" . $row['fecha_activacion'] . "</td>";
            echo "<td>" . $row['valor_plan'] . "</td>";
            echo "<td>" . $row['estado'] . "</td>";
            echo "</tr>";
        }
        ?>
  </tbody>
</table>
                </div>
            </div>
        </div>

    </div>
</div>

    <!-- Repite el mismo proceso para las secciones de Pagos y Clientes -->

    <!-- Enlace a la biblioteca de jQuery y al archivo de JavaScript para validaciones -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="validaciones.js"></script>
    <!-- Enlace a la biblioteca de Bootstrap JavaScript (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
