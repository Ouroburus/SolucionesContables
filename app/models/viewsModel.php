<?php

	namespace app\models;

	class viewsModel{

		/*---------- Modelo obtener vista ----------*/
		protected function obtenerVistasModelo($vista){

			// Lista de vistas permitidas en la aplicación contable
			$listaBlanca=[
				"dashboard", "perfil", "configuracion", "nuevoRegistro", "listaRegistros", 
				"actualizarRegistro", "buscarRegistro", "reporteMensual", "reporteAnual", 
				"nuevoFormulario", "listaFormularios", "actualizarFormulario", "balanceDiario",
				"partidaDiario", "listaCostos", "listaGastos", "estadoFinanciero", "logOut"
			];

			// Verificamos si la vista solicitada está en la lista blanca
			if(in_array($vista, $listaBlanca)){
				// Comprobamos si el archivo de vista existe
				if(is_file("./app/views/content/".$vista."-vista.php")){
					$contenido = "./app/views/content/".$vista."-vista.php";
				}else{
					$contenido = "404";  // Archivo no encontrado
				}
			}elseif($vista == "login" || $vista == "index"){
				$contenido = "login";  // Vista de login
			}else{
				$contenido = "404";  // Vista no encontrada
			}
			
			return $contenido;
		}

	}
