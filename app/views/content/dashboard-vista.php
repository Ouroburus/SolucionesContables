<?php
// Verificar si el usuario está autenticado, si no, redirigir al login
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: ".APP_URL."/login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/styles.css">
</head>
<body>
    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?php echo APP_NAME; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP_URL; ?>/perfil">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP_URL; ?>/logout">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido del Dashboard -->
    <div class="container-fluid">
        <div class="row">
            <!-- Menú lateral -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <span class="fas fa-home"></span>
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo APP_URL; ?>/nuevoCliente">
                                <span class="fas fa-user"></span>
                                Nuevo Cliente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo APP_URL; ?>/listaClientes">
                                <span class="fas fa-users"></span>
                                Lista de Clientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo APP_URL; ?>/nuevoProducto">
                                <span class="fas fa-box"></span>
                                Nuevo Producto
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo APP_URL; ?>/listaProductos">
                                <span class="fas fa-boxes"></span>
                                Lista de Productos
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Panel de Control</h1>
                </div>

                <!-- Sección de tarjetas informativas -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Clientes</div>
                            <div class="card-body">
                                <h5 class="card-title">Total de Clientes</h5>
                                <p class="card-text">50</p> <!-- Puedes reemplazar este valor con una variable dinámica -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Productos</div>
                            <div class="card-body">
                                <h5 class="card-title">Total de Productos</h5>
                                <p class="card-text">120</p> <!-- Puedes reemplazar este valor con una variable dinámica -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header">Ventas</div>
                            <div class="card-body">
                                <h5 class="card-title">Total de Ventas</h5>
                                <p class="card-text">75</p> <!-- Puedes reemplazar este valor con una variable dinámica -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
