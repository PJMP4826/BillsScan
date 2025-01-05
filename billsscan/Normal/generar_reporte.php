<?php
session_start();
$user_id = $_SESSION['id'];
// Conexión a la base de datos (ajusta los datos de conexión)

include_once '../connection.php';

// Ejecutar la consulta SQL
$sql = "SELECT 
    e.denominacion_social AS Empresa_emisora,
    f.fecha_subida AS Fecha_de_registro,
    p.nombre AS Nombre_producto,
    c.total_compra AS Total_compra,
    im.iva AS Impuesto
FROM 
    facturas f
    LEFT JOIN emisor e ON e.id = f.emisor_id
    LEFT JOIN producto p ON f.id = p.facturas_id
    LEFT JOIN importe i ON f.id = i.facturas_id
    LEFT JOIN formapago fp ON f.id = fp.facturas_id
    LEFT JOIN cambio c ON f.id = c.facturas_id
    LEFT JOIN impuestos im ON f.id = im.facturas_id
    LEFT JOIN user u on u.id=f.user_id
    where u.id=$user_id
    ";

$result = $con->query($sql);

// Encabezados para forzar la descarga del archivo Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Reporte_BillScan.xls"');

// Crear la tabla HTML
echo "<table border='1'>";

// Obtener los nombres de las columnas desde la consulta
$field = $result->fetch_fields();
echo "<tr>";
foreach ($field as $key => $value) {
    echo "<th>" . $value->name . "</th>";
}
echo "</tr>";

// Recorrer los resultados y crear las filas de la tabla
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}

echo "</table>";

$con->close();
?>
