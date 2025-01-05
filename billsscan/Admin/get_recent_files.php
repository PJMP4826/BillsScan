<?php
session_start();
// Obtén el ID del usuario desde la sesión
$user_id = $_SESSION['id'];
// Conexión a la base de datos
include_once '../connection.php';


$sql = "SELECT f.imagen_path FROM archivos_recientes as archir
    JOIN facturas_move f ON archir.facturas_move_id = f.id 
    ";

$result = $con->query($sql);

if ($result->num_rows >0) {
    while($row = $result->fetch_assoc()) {
        echo '<div>
                <a href="' . $row["imagen_path"] . '" target="_blank">
                    <img src="' . $row["imagen_path"] . '?t=' . time() . '" class="img-fluid" alt="Factura">
                </a>
              </div>';
    }
} else {
    echo "No hay archivos recientes.";
}

$con->close();
?>




