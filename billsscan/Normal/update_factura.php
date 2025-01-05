<?php
// Conexión a la base de datos
include_once '../connection.php';


// Procesar actualización si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $factura_id = $con->real_escape_string($_POST['factura_id']);
    $empresa_emisora = $con->real_escape_string($_POST['empresa_emisora']);
    $fecha_subida = $con->real_escape_string($_POST['fecha_subida']);
    $nombre_producto = $con->real_escape_string($_POST['nombre_producto']);
    $total_producto = $con->real_escape_string($_POST['total_producto']);
    $metodo_pago = $con->real_escape_string($_POST['metodo_pago']);
    $total_compra = $con->real_escape_string($_POST['total_compra']);
    $cambio = $con->real_escape_string($_POST['cambio']);
    $subtotal = $con->real_escape_string($_POST['subtotal']);
    $impuesto = $con->real_escape_string($_POST['impuesto']);
    $numero_factura = $con->real_escape_string($_POST['numero_factura']);
    $direccion = $con->real_escape_string($_POST['direccion']);

    // Actualizar la información en las tablas correspondientes
    $con->query("UPDATE emisor SET denominacion_social='$empresa_emisora', direccion='$direccion' WHERE id=(SELECT emisor_id FROM facturas WHERE id=$factura_id)");
    $con->query("UPDATE facturas SET fecha_subida='$fecha_subida', numero_factura='$numero_factura' WHERE id=$factura_id");
    $con->query("UPDATE producto SET nombre='$nombre_producto' WHERE facturas_id=$factura_id");
    $con->query("UPDATE importe SET precio_unitario='$total_producto' WHERE facturas_id=$factura_id");
    $con->query("UPDATE formapago SET forma_pago='$metodo_pago' WHERE facturas_id=$factura_id");
    $con->query("UPDATE cambio SET total_compra='$total_compra', cantidad_cambio='$cambio' WHERE facturas_id=$factura_id");
    $con->query("UPDATE impuestos SET subtotal='$subtotal', iva='$impuesto' WHERE facturas_id=$factura_id");

    // Redirigir de vuelta a la página principal después de la actualización
    header("Location: facturas.php");
    exit();
}

$con->close();
?>
