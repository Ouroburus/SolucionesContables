<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Soluciones Contables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #343a40; /* Color de fondo de la navbar */
        }
        .navbar-brand {
            color: #ffffff; /* Color del texto de la marca */
        }
        .nav-link {
            color: #ffffff; /* Color de los enlaces */
        }
        .nav-link:hover {
            color: #f8f9fa; /* Color del texto al pasar el mouse */
        }
        .dashboard {
            padding: 20px;
        }
        .btn-dashboard {
            width: 200px;
            height: 100px;
            margin: 10px;
            font-size: 18px;
            font-weight: bold;
        }
        .btn-custom {
            background-color: #007bff; /* Color de fondo personalizado */
            color: #ffffff; /* Color del texto */
        }
        .btn-custom:hover {
            background-color: #0056b3; /* Color al pasar el mouse */
        }
        .dropdown-menu {
            left: -100px; /* Ajuste del menú desplegable para alinearlo bien */
        }
    </style>
</head>
<body>
<?php include 'app/views/layouts/header.php'?>
    

    <div class="container dashboard">
        <h1 class="text-center">Dashboard</h1>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <a href="#" class="btn btn-custom btn-dashboard">Compras</a>
            </div>
            <div class="col-md-3">
                <a href="#" class="btn btn-custom btn-dashboard">Ventas Consumidor</a>
            </div>
            <div class="col-md-3">
                <a href="#" class="btn btn-custom btn-dashboard">Ventas Contribuyente</a>
            </div>
            <div class="col-md-3">
                <a href="#" class="btn btn-custom btn-dashboard">Planillas</a>
            </div>
            <div class="col-md-3">
                <a href="#" class="btn btn-custom btn-dashboard">Costos y Gastos</a>
            </div>
            <div class="col-md-3">
                <a href="#" class="btn btn-custom btn-dashboard">Balance General</a>
            </div>
        </div>
    </div>
    <?php include 'app/views/layouts/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
