<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Soluciones Contables</title>
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
        .dropdown-menu {
            left: -100px; /* Ajuste del menú desplegable para alinearlo bien */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Soluciones Contables</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../../index.php">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="librosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Libros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="librosDropdown">
                            <li><a class="dropdown-item" href="app/views/content/Compras.php">Compras</a></li>
                            <li><a class="dropdown-item" href="app/views/content/LibroContribuyente.php">Ventas a Contribuyentes</a></li>
                            <li><a class="dropdown-item" href="app/views/content/ventasconsumidor.php">Ventas a Consumidor Final</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="app/views/content/planilla.php">Planillas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="app/views/content/LibroContribuyente.php">Costos y Gastos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="app/views/content/balanseGeneral.php">Balance General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Configuración</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="path/to/profile-icon.png" alt="Perfil" style="width: 24px; height: 24px;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                        <li><a class="dropdown-item" href="#">Modificar perfil</a></li>
                        <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
