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
            padding: 10px 20px;
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
                                <i class="fas fa-file-invoice-dollar"></i> Formulario Planillas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form_patente.php">
                                <i class="fas fa-building"></i> Formulario Patente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="partidas_diario.php">
                                <i class="fas fa-book"></i> Partidas de Diario
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="balances_diarios.php">
                                <i class="fas fa-balance-scale"></i> Balances Diarios
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
                        <a href="form_iva.php" class="btn btn-dashboard">
                            Planillas
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="form_patente.php" class="btn btn-dashboard">
                            Formulario Patente
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="partidas_diario.php" class="btn btn-dashboard">
                            Partidas de Diario
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="balances_diarios.php" class="btn btn-dashboard">
                            Balances Diarios
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="costos_gastos.php" class="btn btn-dashboard">
                            Costos y Gastos
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
