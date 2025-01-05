<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conectar a la base de datos
    include_once '../connection.php';

    // Iniciar la transacción
    $con->begin_transaction();

    try {
        // Eliminar registros relacionados
        $sql_archivos_recientes = "
            DELETE archivos_recientes, facturas_move 
            FROM archivos_recientes
            LEFT JOIN facturas_move ON archivos_recientes.facturas_move_id = facturas_move.id
            WHERE archivos_recientes.user_id = $id
        ";
        $con->query($sql_archivos_recientes);

        $sql_facturas = "
            DELETE impuestos, formapago, cambio, importe, producto 
            FROM facturas
            LEFT JOIN impuestos ON facturas.id = impuestos.facturas_id
            LEFT JOIN formapago ON facturas.id = formapago.facturas_id
            LEFT JOIN cambio ON facturas.id = cambio.facturas_id
            LEFT JOIN importe ON facturas.id = importe.facturas_id
            LEFT JOIN producto ON facturas.id = producto.facturas_id
            WHERE facturas.user_id = $id
        ";
        $con->query($sql_facturas);

        // Eliminar facturas y el usuario después de las dependencias
        $con->query("DELETE FROM facturas WHERE user_id = $id");
        $con->query("DELETE FROM user WHERE id = $id");

        // Confirmar la transacción
        $con->commit();

        // Redirigir con éxito
        header("Location: admin_usuarios.php?status=eliminado");
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $con->rollback();

        // Redirigir con error
        header("Location: admin_usuarios.php?status=error");
    }

    // Cerrar la conexión
    $con->close();
    exit;
} else {
    echo "ID de empleado no especificado.";
}
?>
