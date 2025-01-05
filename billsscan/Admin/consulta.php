<?php
session_start(); // Iniciar la sesión

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    die("Acceso no autorizado. Inicie sesión para continuar.");
}

// Obtén el ID del usuario desde la sesión
$user_id = $_SESSION['id'];
// Consulta para obtener los datos de la factura
$consulta = "Extrae los datos de la factura adjunta sin realizar inferencias y sin añadir explicaciones adicionales. Si un dato no está presente, indica (no encontrado). Responde únicamente con los datos en el siguiente formato:

denominacionSocial: [valor]
cif: [valor]
direccion: [valor]
numero_factura: [valor]
fechaExpedicion: [valor]
horaExpedicion: [valor]
producto: [valor]
importeTotal: [valor]
forma de pago: [valor]
cambio: [valor]
total_compra: [valor]
sub_total: [valor]
iva: [valor]

Ejemplo:
denominacionSocial: Liverpool
cif: No encontrado
direccion: Avenida Polanco
numero_factura: 2359
fechaExpedicion: 3-Jul-2003
horaExpedicion: 9:53
producto: Paraguas
importeTotal: $45.00
forma de pago: Contado
cambio: No encontrado
total_compra: $45.00
sub_total: No encontrado
iva: No encontrado

Por favor, responde solo con los datos en este formato.
Nota denominacionSocial es el nombre de la empresa (generalmente esta escrito en grande o resaltado con otro tipo de letra o color) arriba de la imagen, pero tu la llamara en tu respuesta como denominacionSocial";

// Obtiene la imagen y la guarda en una ubicación temporal
$imagenTemporal = tempnam(sys_get_temp_dir(), 'imagen_');
move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenTemporal);

$url = 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=AIzaSyAhrjd2eqHuK-5WbGg2ezig_CtL2eE3Kzc';

$datos = [
    'contents' => [
        [
            'parts' => [
                [
                    'text' => $consulta
                ],
                [
                    'inline_data' => [
                        'mime_type' => 'image/jpeg',
                        'data' => base64_encode(file_get_contents($imagenTemporal))
                    ]
                ]
            ]
        ]
    ]
];

$datosJSON = json_encode($datos);

// Configura las opciones de la solicitud cURL
$opciones = [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => '',
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $datosJSON,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
];

// Inicializa cURL y configura las opciones
$curl = curl_init();
curl_setopt_array($curl, $opciones);

// Ejecuta la solicitud cURL
$respGemini = curl_exec($curl);

// Transformamos a formato JSON
$respuesta = json_decode($respGemini, true);

// Cierra la sesión cURL
curl_close($curl);

// Elimina el archivo temporal
unlink($imagenTemporal);

// Procesamos los datos
$datosFactura = $respuesta['candidates'][0]['content']['parts'][0]['text'];

// Convierte los datos en un array asociativo
$datosFacturaArray = [];
preg_match_all('/(\w+):\s*([^\n]*)/', $datosFactura, $matches, PREG_SET_ORDER);
foreach ($matches as $match) {
    $datosFacturaArray[$match[1]] = trim($match[2]);
}

// Conexión a la base de datos
include_once '../connection.php';


// Inserta los datos en la base de datos
$denominacion_social = $con->real_escape_string($datosFacturaArray['denominacionSocial']);
$cif = $con->real_escape_string($datosFacturaArray['cif']);
$direccion = $con->real_escape_string($datosFacturaArray['direccion']);

$sqlEmisor = "INSERT INTO emisor (denominacion_social, cif, direccion) VALUES ('$denominacion_social', '$cif', '$direccion')";
if ($con->query($sqlEmisor) === TRUE) {
    $emisor_id = $con->insert_id;

    $numero_factura = $con->real_escape_string($datosFacturaArray['numero_factura']);
    $fecha_expedicion = $con->real_escape_string($datosFacturaArray['fechaExpedicion']);
    $hora_expedicion = $con->real_escape_string($datosFacturaArray['horaExpedicion']);

    $sqlFactura = "INSERT INTO facturas (numero_factura, emisor_id, user_id) VALUES ('$numero_factura', '$emisor_id', '$user_id')";
    if ($con->query($sqlFactura) === TRUE) {
        $facturas_id = $con->insert_id;

        $producto = $con->real_escape_string($datosFacturaArray['producto']);
        $importe_total = $con->real_escape_string($datosFacturaArray['importeTotal']);
        $forma_pago = $con->real_escape_string($datosFacturaArray['forma_pago']);
        $cambio = $con->real_escape_string($datosFacturaArray['cambio']);
        $total_compra = $con->real_escape_string($datosFacturaArray['total_compra']);
        $subtotal = $con->real_escape_string($datosFacturaArray['sub_total']);
        $iva = $con->real_escape_string($datosFacturaArray['iva']);

        // Inserta los productos, importes, forma de pago, cambio y impuestos
        $sqlProducto = "INSERT INTO producto (nombre, facturas_id) VALUES ('$producto', '$facturas_id')";
        $con->query($sqlProducto);

        $sqlImporte = "INSERT INTO importe (precio_unitario, importe_total, facturas_id) VALUES ('$precio_unitario', '$importe_total', '$facturas_id')";
        $con->query($sqlImporte);

        $sqlFormaPago = "INSERT INTO formapago (forma_pago, facturas_id) VALUES ('$forma_pago', '$facturas_id')";
        $con->query($sqlFormaPago);

        $sqlCambio = "INSERT INTO cambio (cantidad_cambio, total_compra, facturas_id) VALUES ('$cambio', '$total_compra', '$facturas_id')";
        $con->query($sqlCambio);

        $sqlImpuestos = "INSERT INTO impuestos (subtotal, iva, facturas_id) VALUES ('$subtotal', '$iva', '$facturas_id')";
        $con->query($sqlImpuestos);
    }
}

$con->close();

// Envia la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode(['mensaje' => 'Datos guardados en la base de datos correctamente.']);
?>
