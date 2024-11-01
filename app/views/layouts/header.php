<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soluciones Contables</title>
    <style>
        /* Navbar styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            padding: 10px 20px;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
            text-decoration: none;
        }

        /* Horizontal menu styling */
        .navbar-nav {
            display: flex;
            gap: 15px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-nav > li {
            position: relative;
        }

        .navbar-nav > li > a {
            text-decoration: none;
            color: #333;
            padding: 8px 12px;
            display: inline-block;
        }

        .navbar-nav > li > a:hover {
            color: #007bff;
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            list-style: none;
            padding: 0;
            margin: 0;
            min-width: 200px;
            z-index: 1000;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }

        /* Show dropdown when parent has 'show' class */
        .dropdown.show .dropdown-menu {
            display: block;
        }

        /* Profile menu */
        .profile-icon {
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .dropdown-profile-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            list-style: none;
            padding: 0;
            margin: 0;
            min-width: 200px;
            z-index: 1000;
        }

        .dropdown-profile-menu a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
        }

        .dropdown-profile-menu a:hover {
            background-color: #f1f1f1;
        }

        /* Show profile dropdown */
        .profile-dropdown.show .dropdown-profile-menu {
            display: block;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a class="navbar-brand" href="#">Soluciones Contables</a>
    <ul class="navbar-nav">
        <li><a href="#">Inicio</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" onclick="toggleDropdown(event)">Libros</a>
            <ul class="dropdown-menu">
                <li><a href="../content/Compras.php">Compras</a></li>
                <li><a href="../content/LibroContribuyente.php">Ventas a Contribuyentes</a></li>
                <li><a href="../content/ventasconsumidor.php">Ventas a Consumidor Final</a></li>
            </ul>
        </li>
        <li><a href="../content/planilla.php">Planillas</a></li>
        <li><a href="../content/ventasconsumidor.php">Costos y Gastos</a></li>
        <li><a href="../content/balanseGeneral.php">Balance General</a></li>
        <li><a href="#">Configuración</a></li>
    </ul>
    <div class="profile-icon profile-dropdown" onclick="toggleProfileDropdown(event)">
        <img src="icons/profile-icon.svg" alt="Perfil" width="24" height="24">
        <ul class="dropdown-profile-menu">
            <li><a href="#">Modificar Perfil</a></li>
            <li><a href="#">Cambiar Contraseña</a></li>
            <li><a href="#">Cerrar Sesión</a></li>
        </ul>
    </div>
</nav>

<script>
    // Función para mostrar y ocultar el menú dropdown
    function toggleDropdown(event) {
        const dropdown = event.currentTarget.parentElement;
        dropdown.classList.toggle('show');
    }

    // Función para mostrar y ocultar el menú de perfil
    function toggleProfileDropdown(event) {
        const profileDropdown = event.currentTarget;
        profileDropdown.classList.toggle('show');
    }

    // Cerrar el dropdown al hacer clic fuera de él
    document.addEventListener('click', (event) => {
        const isDropdown = event.target.closest('.dropdown');
        const isProfileDropdown = event.target.closest('.profile-dropdown');
        
        if (!isDropdown) {
            document.querySelectorAll('.dropdown').forEach(dropdown => dropdown.classList.remove('show'));
        }
        
        if (!isProfileDropdown) {
            document.querySelectorAll('.profile-dropdown').forEach(dropdown => dropdown.classList.remove('show'));
        }
    });
</script>

</body>
</html>
