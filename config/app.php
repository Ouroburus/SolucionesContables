<?php

	const APP_URL = "http://localhost/SolucionesContables/";
	const APP_NAME = "Soluciones Contables";
	const APP_SESSION_NAME = "CONTABILIDAD";

	/*----------  Tipos de documentos  ----------*/
	const DOCUMENTOS_USUARIOS = ["DUI", "DNI", "Cédula", "Licencia", "Pasaporte", "Otro"];

	/*----------  Tipos de unidades de productos  ----------*/
	const PRODUCTO_UNIDAD = ["Unidad", "Libra", "Kilogramo", "Caja", "Paquete", "Lata", "Galón", "Botella", "Tira", "Sobre", "Bolsa", "Saco", "Tarjeta", "Otro"];

	/*----------  Configuración de moneda  ----------*/
	const MONEDA_SIMBOLO = "$";
	const MONEDA_NOMBRE = "USD";
	const MONEDA_DECIMALES = "2";
	const MONEDA_SEPARADOR_MILLAR = ",";
	const MONEDA_SEPARADOR_DECIMAL = ".";

	/*----------  Marcador de campos obligatorios (Font Awesome) ----------*/
	const CAMPO_OBLIGATORIO = '&nbsp; <i class="fas fa-edit"></i> &nbsp;';

	/*----------  Zona horaria  ----------*/
	date_default_timezone_set("America/El_Salvador");
?>
