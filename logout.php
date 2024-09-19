<?php
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión actual
session_destroy();

// Redirigir al formulario de login después de cerrar la sesión
header('Location: login.php');
exit();
