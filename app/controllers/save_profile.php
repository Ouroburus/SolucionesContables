<?php
// Archivo controlador: save_profile.php

// Conexión a la base de datos (MongoDB)
require_once(__DIR__ . '/../../config/database.php'); // Asegúrate de que 'database4.php' conecte a MongoDB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $suscripcion = $_POST['suscripcion'];
    $fecha_pago = $_POST['fecha_pago'];

    // ID del usuario que deseas actualizar (probablemente lo obtienes de la sesión)
    $id_usuario = $_POST['id_usuario']; // Asegúrate de pasar el `id_usuario` por el formulario

    try {
        // Seleccionar la base de datos y la colección
        $collection = $db->user; // Reemplaza 'user' por el nombre de tu colección si es diferente

        // Crear el filtro para encontrar el documento a actualizar
        $filtro = ['_id' => new MongoDB\BSON\ObjectId($id_usuario)];

        // Los nuevos valores a actualizar
        $nuevos_datos = [
            '$set' => [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario,
                'suscripcion' => $suscripcion,
                'fecha_pago' => $fecha_pago
            ]
        ];

        // Ejecutar la consulta de actualización
        $result = $collection->updateOne($filtro, $nuevos_datos);

        if ($result->getModifiedCount() > 0) {
            echo "Datos actualizados correctamente";
        } else {
            echo "No se realizó ninguna actualización";
        }
    } catch (Exception $e) {
        echo "Error al actualizar los datos: " . $e->getMessage();
    }
} else {
    // Si no es una solicitud POST, puedes obtener el ID del usuario de la sesión o redirigir
    session_start();
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];

        // Cargar los datos del usuario para mostrarlos en el formulario
        $collection = $db->user; // Reemplaza 'user' por el nombre de tu colección si es diferente
        $filtro = ['_id' => new MongoDB\BSON\ObjectId($id_usuario)];
        $usuario = $collection->findOne($filtro);

        if ($usuario) {
            // Aquí puedes mostrar los datos en el formulario
            $nombre = $usuario->nombre;
            $apellido = $usuario->apellido;
            $usuario_nombre = $usuario->usuario;
            $suscripcion = $usuario->suscripcion;
            $fecha_pago = $usuario->fecha_pago;

            // Mostrar el formulario con los datos cargados
            echo '<form method="POST" action="">
                    <input type="hidden" name="id_usuario" value="' . $id_usuario . '">
                    <input type="text" name="nombre" value="' . htmlspecialchars($nombre) . '">
                    <input type="text" name="apellido" value="' . htmlspecialchars($apellido) . '">
                    <input type="text" name="usuario" value="' . htmlspecialchars($usuario_nombre) . '">
                    <input type="text" name="suscripcion" value="' . htmlspecialchars($suscripcion) . '">
                    <input type="text" name="fecha_pago" value="' . htmlspecialchars($fecha_pago) . '">
                    <button type="submit">Actualizar</button>
                  </form>';
        } else {
            echo "Usuario no encontrado.";
        }
    } else {
        echo "No has iniciado sesión.";
    }
}

