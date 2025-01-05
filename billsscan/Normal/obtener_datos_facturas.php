<?php
session_start();
$user_id = $_SESSION['id'];
// Conexión a la base de datos (reemplaza con tus credenciales)
include_once '../connection.php';

// Consulta SQL para obtener el número de facturas por día
$sql = "SELECT DATE(fecha_subida) AS fecha, COUNT(*) AS cantidad_facturas
        FROM facturas AS F
        INNER JOIN USER AS U ON u.id=f.user_id
        WHERE fecha_subida BETWEEN '2024-01-01' AND '2024-12-31' 
        AND u.id=$user_id
        GROUP BY fecha";

$result = $con->query($sql);

// Convertir los resultados a formato JSON
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);

$con->close();
?>
