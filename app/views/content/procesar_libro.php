<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_contribuyente = $_POST['nombre_contribuyente'];
    $nrc = $_POST['nrc'];
    $mes = $_POST['mes'];
    $anio = $_POST['anio'];

    $dia = $_POST['dia'];
    $correlativo = $_POST['correlativo'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $nrc_cliente = $_POST['nrc_cliente'];
    $propias_exentas = $_POST['propias_exentas'];
    $propias_gravadas = $_POST['propias_gravadas'];
    $debito_fiscal = $_POST['debito_fiscal'];
    $terceros_exentas = $_POST['terceros_exentas'];
    $terceros_gravadas = $_POST['terceros_gravadas'];
    $total = $_POST['total'];
    $iva_retenido = $_POST['iva_retenido'];

    // Aquí puedes guardar los datos en una base de datos o generar un reporte
    echo "<h1>Datos guardados correctamente</h1>";
    echo "<p>Contribuyente: $nombre_contribuyente</p>";
    echo "<p>NRC: $nrc</p>";
    echo "<p>Mes: $mes / Año: $anio</p>";

    echo "<table border='1'>";
    echo "<tr>
        <th>Día</th><th>Correlativo</th><th>Cliente</th><th>NRC Cliente</th>
        <th>Propias Exentas</th><th>Propias Gravadas</th><th>Débito Fiscal</th>
        <th>Terceros Exentas</th><th>Terceros Gravadas</th><th>Total</th><th>IVA Retenido</th>
    </tr>";
    
    for ($i = 0; $i < count($dia); $i++) {
        echo "<tr>";
        echo "<td>{$dia[$i]}</td>";
        echo "<td>{$correlativo[$i]}</td>";
        echo "<td>{$nombre_cliente[$i]}</td>";
        echo "<td>{$nrc_cliente[$i]}</td>";
        echo "<td>{$propias_exentas[$i]}</td>";
        echo "<td>{$propias_gravadas[$i]}</td>";
        echo "<td>{$debito_fiscal[$i]}</td>";
        echo "<td>{$terceros_exentas[$i]}</td>";
        echo "<td>{$terceros_gravadas[$i]}</td>";
        echo "<td>{$total[$i]}</td>";
        echo "<td>{$iva_retenido[$i]}</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
