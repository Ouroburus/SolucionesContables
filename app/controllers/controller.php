<?php

namespace app\controllers;

use app\models\viewsModel;

require './app/models/viewsModel.php';


class Controller {

    /*---------- Controlador para obtener vistas ----------*/
    public function obtenerVistaControlador($vista) {
        $modeloVista = new viewsModel();
        $vistaSolicitada = $modeloVista->obtenerVistasModelo($vista);  // Cambiado a obtenerVistasModelo
    
        if ($vistaSolicitada == "404") {
            include "./app/views/content/404-vista.php";
        } else {
           // include $vistaSolicitada;
        }
    }

    /*---------- Controlador para manejar las peticiones ----------*/
    public function manejarPeticionesControlador() {
        // Iniciar sesión o verificar si ya está iniciada
        session_start();

        // Verificar si hay una solicitud de página
        if (isset($_GET['vista'])) {
            $vista = $_GET['vista'];
        } else {
            $vista = 'login'; // Página por defecto
        }

        // Control de acceso según sesión
        if (!isset($_SESSION['usuario']) && $vista != 'login') {
            // Si no está logueado, redirigir al login
            header("Location: index.php?vista=login");
            exit();
        }

        // Obtener la vista solicitada
        $this->obtenerVistaControlador($vista);
    }

    /*---------- Controlador para cerrar sesión ----------*/
    public function cerrarSesionControlador() {
        session_start();
        session_destroy();
        header("Location: index.php?vista=login");
        exit();
    }
}
?>