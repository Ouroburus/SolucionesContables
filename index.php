<?php

require_once 'config/app.php';
require_once './app/controllers/controller.php';

$controlador = new \app\controllers\Controller();
$controlador->manejarPeticionesControlador();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soluciones Contables - Dashboard</title>



    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .sidebar {
            background-color: #35617e;
            height: 100vh;
            width: 25vh;
        }
        .sidebar .nav-link {
            color: #f2f2f2;
        }
        .sidebar .nav-link.active {
            font-weight: bold;
        }
        .header {
            background-color: #35617e;
            color: white;
            padding: 5px 10px;
        }
        .header .navbar-brand {
            font-size: 1.5rem;
        }
        .header .profile-icon {
            cursor: pointer;
        }
        .content {
            padding: 20px;
        }
        .btn-dashboard {
            width: 100%;
            padding: 20px;
            background-color: #ff6f61;
        }
        .btn-dashboard:hover {
            background-color: #35617e;
            color: #f2f2f2;
        }
    </style>
</head>
<body>



    <!-- Header -->
    <header class="navbar navbar-dark header">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Soluciones Contables</a>
            <div class="dropdown">
                <i class="fas fa-user-circle fa-2x profile-icon" id="profileDropdown" data-bs-toggle="dropdown"></i>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="configuracion.php">Editar Perfil</a></li>
                    <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Menú lateral -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="fas fa-home"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form_iva.php">
                                <i class="fas fa-file-invoice-dollar"></i>Compras
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form_patente.php">
                                <i class="fas fa-building"></i> Ventas Contribuyente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="partidas_diario.php">
                                <i class="fas fa-book"></i> Ventas Consumidor Final
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="balances_diarios.php">
                                <i class="fas fa-balance-scale"></i>Planillas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="costos_gastos.php">
                                <i class="fas fa-calculator"></i> Costos y Gastos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="configuracion.php">
                                <i class="fas fa-cog"></i> Configuración
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Botones del dashboard -->
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <a href="app/views/content/Compras.php" class="btn btn-dashboard">
                            Compras
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="app/views/content/LibroContribuyente.php" class="btn btn-dashboard">
                             Ventas Contribuyente 
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="app/views/content/ventasconsumidor.php" class="btn btn-dashboard">
                            Ventas Consumidor Final
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="app/views/content/planilla.php" class="btn btn-dashboard">
                            Planillas de salario
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="app/views/content/balanseGeneral.php" class="btn btn-dashboard">
                            Balance General
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="app/views/content/VistaCompras.php" class="btn btn-dashboard">
                            Vista Compras
                        </a>
                    </div>
                    
                </div>
            </main>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'app/views/layouts/footer.php'; ?>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
