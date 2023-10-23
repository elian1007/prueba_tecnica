<?php
// archivo.php
include 'layout/menu.html';

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
                    <h6 class="card-title m-0 fw-bold">Formulario de Pagos</h6>
                </div>
                <form action="contratos.php" method="post" class="needs-validation" id="form-company">
               
                    <div class="card-body d-flex flex-column">
                        <div class="row mb-3">
                         
                            <div class="col-md-12 form-group my-2">
                            <label for="fecha" class="form-label">Codigo contrato<span
                                 class="text-danger">*</span></label>
                                <input type="text" name="codigo_contrato" placeholder="codigo_contrato" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-12 form-group my-2">
                           
                            <div class="col-md-12 form-group my-2">
                            <label for="fecha" class="form-label">Monto a pagar<span
                                    class="text-danger">*</span></label>
                                <input type="text" name="monto" placeholder="Monto de pago" class="form-control" id="code" value="" required>
                            </div>
                            <div class="col-md-12 form-group my-2">
                                <label for="fecha" class="form-label">Fecha de pago<span
                                    class="text-danger">*</span></label>
                                <input type="date" name="fecha" placeholder="fecha de pago" class="form-control" id="code" value="" required>
                            </div>
                            </div>



                        </div>
                        <div class="d-flex align-self-end">
                            <button id="btn-save" type="submit" class="btn btn-success flex-grow-0 mt-3 ">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
