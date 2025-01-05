<?php
session_start();

$user_id = $_SESSION['id'];
// Conexión a la base de datos
include_once '../connection.php';


$sql = "SELECT f.imagen_path FROM archivos_recientes as archir
    JOIN facturas_move f ON archir.facturas_move_id = f.id 
    INNER JOIN `user` as u on u.id=archir.user_id
    where u.id= $user_id
    ORDER BY archir.fecha_subida DESC
    ";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="image-container">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="image-item">
    <a href="' . $row["imagen_path"] . '" target="_blank">
            <img src="' . $row["imagen_path"] . '" class="img-fluid" alt="Factura">
          </a>
            </div>';
    }
    echo '</div>';
} else {
    echo "No hay archivos recientes.";
}

$con->close();

?>

