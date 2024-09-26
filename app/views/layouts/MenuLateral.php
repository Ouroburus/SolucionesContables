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
                                <i class="fas fa-file-invoice-dollar"></i>  Compras
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