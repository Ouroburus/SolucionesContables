<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        /* Estilos para el menú */
        .navbar {
            background-color: #add8e6; /* Fondo azul suave */
        }
        .nav-link {
            color: #000;
        }
        
        .dropdown-item:hover {
            background-color: #2cf614; /* Sombreado de los elementos del dropdown */
        }
        .profile-link {
            width: 30px; /* Ajusta el tamaño de la imagen de perfil */
            height: 30px;
            border-radius: 50%; /* Hacer la imagen redonda */
        }
        .navbar-brand {
            font-weight: bold; /* Título en negrita */
        }
        .titulo1 {
    font-size: 1.4rem; /* Tamaño de fuente grande */
    font-weight: bold; /* Negrita */
    color: #000; /* Color de texto negro */
    text-align: center; /* Centrado */
    margin: 20px 0; /* Espaciado superior e inferior */
  
    
    
}

.titulo1:hover {
    color: #3498db; /* Cambia el color del texto al pasar el mouse */
}



    </style>
    <title>Header - Soluciones Contables</title>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
    <a href="index.php" class="titulo1">SOLUCIONES CONTABLES</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Libros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown1">
                        <li><a class="dropdown-item" href="../content/Compras.php">Compras</a></li>
                        <li><a class="dropdown-item" href="../content/LibroContribuyente.php">Ventas Contribuyente</a></li>
                        <li><a class="dropdown-item" href="../content/ventasconsumidor.php">Ventas Consumidor final</a></li>
                        <li><a class="dropdown-item" href="../content/planilla.php">Planillas</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ver Libros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown2">
                        <li><a class="dropdown-item" href="../content/VistaCompras.php">Compras</a></li>
                        <li><a class="dropdown-item" href="../content/vistaContribuyente.php">Ventas Contribuyente</a></li>
                        <li><a class="dropdown-item" href="../content/vistaConsumidorF.php">Ventas Consumidor final</a></li>
                        <li><a class="dropdown-item" href="../content/vistaPlanilla.php">Planillas</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Opción 3
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown3">
                        <li><a class="dropdown-item" href="../content/partidaD.php">Partidas</a></li>
                        <li><a class="dropdown-item" href="../content/vistaCatalogo.php">Catálogo</a></li>
                        <li><a class="dropdown-item" href="#">Subopción 3.3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Opción 4
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown4">
                        <li><a class="dropdown-item" href="#">Subopción 4.1</a></li>
                        <li><a class="dropdown-item" href="#">Subopción 4.2</a></li>
                        <li><a class="dropdown-item" href="#">Subopción 4.3</a></li>
                    </ul>
                </li>
            </ul>
                <img src="/layouts/icons/Logo1.png" alt="Logo" class="profile-link"> 
        
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
