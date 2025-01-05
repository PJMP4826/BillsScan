
<style>
.negrita {
    font-weight: bold;
    color: black !important;
    margin-top: 4px !important;
    margin-bottom: 0;
}


.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: 60px;
}



.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 10px;
}

.modal-title{
    font-size: 20px;
    font-family: 'Jost';
    margin-top: 25px;
    margin-bottom: 10px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.btn-primary {
        padding: 10px;
        background-color: #21BF73;
        margin-left: 9px;
        border-radius: 7px;
        border: none;
        font-family: 'Jost';
    }

    .btn-danger {
        padding: 10px 12px;
        background-color: #EB5353;
        border-radius: 7px;
        border: none;
        font-family: 'Jost';
    }

    .botones {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .btn-primary:hover {
        transform: scale(1.1)
    }

    .btn-danger:hover {
        transform: scale(1.1);
    }

    .modal-header{
        display: flex;
        justify-content: space-between;
    }

    .btn-close{
        background-color: white;
        border: none;
        margin-bottom: 25px;
    }


</style>
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtén el ID del usuario desde la sesión
$user_id = $_SESSION['id'];

// Conexión a la base de datos
include_once '../connection.php';


// Procesar eliminación si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $con->real_escape_string($_POST['delete_id']);

    // Eliminar registros de 'archivos_recientes' relacionados
    $sql_archivos_recientes = "
        DELETE FROM archivos_recientes
        WHERE facturas_move_id IN (
            SELECT id 
            FROM (
                SELECT fm.id 
                FROM facturas f
                JOIN facturas_move fm 
                ON fm.fecha_subida BETWEEN DATE_SUB(f.fecha_subida, INTERVAL 5 SECOND) AND DATE_ADD(f.fecha_subida, INTERVAL 5 SECOND)
                WHERE f.id = $delete_id
            ) AS subquery
        )";
    $con->query($sql_archivos_recientes);

    // Eliminar registros de 'facturas_move' relacionados
    $sql_facturas_move = "
        DELETE FROM facturas_move 
        WHERE fecha_subida IN (
            SELECT fecha_subida
            FROM (
                SELECT fm.fecha_subida 
                FROM facturas f
                JOIN facturas_move fm 
                ON fm.fecha_subida BETWEEN DATE_SUB(f.fecha_subida, INTERVAL 5 SECOND) AND DATE_ADD(f.fecha_subida, INTERVAL 5 SECOND)
                WHERE f.id = $delete_id
            ) AS subquery
        )";
    $con->query($sql_facturas_move);

    // Eliminar registros de las tablas dependientes de 'proyecto_facturas'
    $con->query("DELETE FROM impuestos WHERE facturas_id = $delete_id");
    $con->query("DELETE FROM formapago WHERE facturas_id = $delete_id");
    $con->query("DELETE FROM importe WHERE facturas_id = $delete_id");
    $con->query("DELETE FROM cambio WHERE facturas_id = $delete_id");
    $con->query("DELETE FROM producto WHERE facturas_id = $delete_id");

    // Eliminar el registro de la tabla 'proyecto_facturas'
    $con->query("DELETE FROM facturas WHERE id = $delete_id");

    // Eliminar registros de la tabla 'proyecto_emisor' que dependían de 'proyecto_facturas'
    $con->query("DELETE FROM emisor WHERE id NOT IN (SELECT emisor_id FROM facturas)");
}

// Obtener parámetros de búsqueda si existen
// Obtener parámetros de búsqueda si existen
$search = isset($_GET['search']) ? $con->real_escape_string($_GET['search']) : '';
$start_date = isset($_GET['start_date']) ? $con->real_escape_string($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? $con->real_escape_string($_GET['end_date']) : '';
$mes = isset($_GET['mes']) ? (int)$con->real_escape_string($_GET['mes']) : 0;
$start_time = isset($_GET['start_time']) ? $con->real_escape_string($_GET['start_time']) : '';
$end_time = isset($_GET['end_time']) ? $con->real_escape_string($_GET['end_time']) : '';

$sql = "
    SELECT 
        f.id AS Factura_ID,
        e.denominacion_social AS Empresa_Emisora,
        f.fecha_subida AS Fecha_Subida,
        p.nombre AS Nombre_Producto,
        i.precio_unitario AS Total_Producto,
        fp.forma_pago AS Metodo_Pago,
        c.total_compra AS Total_Compra,
        c.cantidad_cambio AS Cambio,
        im.subtotal AS Subtotal,
        im.iva AS Impuesto,
        f.numero_factura AS Numero_Factura,
        e.direccion AS Direccion,
        (SELECT fm.imagen_path 
         FROM facturas_move fm 
         WHERE fm.fecha_subida BETWEEN DATE_SUB(f.fecha_subida, INTERVAL 5 SECOND) AND DATE_ADD(f.fecha_subida, INTERVAL 5 SECOND)
         LIMIT 1) AS Imagen_Path,
         u.fname as Usuario
    FROM 
        facturas f
        LEFT JOIN emisor e ON e.id = f.emisor_id
        LEFT JOIN producto p ON f.id = p.facturas_id
        LEFT JOIN importe i ON f.id = i.facturas_id
        LEFT JOIN formapago fp ON f.id = fp.facturas_id
        LEFT JOIN cambio c ON f.id = c.facturas_id
        LEFT JOIN impuestos im ON f.id = im.facturas_id
        left join user u on f.user_id=u.id
    WHERE 
        f.user_id = $user_id AND
        (e.denominacion_social LIKE '%$search%' 
         OR p.nombre LIKE '%$search%' 
         OR e.direccion LIKE '%$search%')
";

// Filtrar por rango de fechas
if (!empty($start_date) && !empty($end_date)) {
    // Si también se proporciona una hora de inicio y fin
    if (!empty($start_time) && !empty($end_time)) {
        $sql .= " AND f.fecha_subida BETWEEN '$start_date $start_time' AND '$end_date $end_time'";
    } else {
        $sql .= " AND f.fecha_subida BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'";
    }
}

// Filtro por mes
if ($mes > 0 && $mes <= 12) {
    $sql .= " AND MONTH(f.fecha_subida) = $mes";
}

$sql .= " ORDER BY f.fecha_subida DESC";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="grid-container">';
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="grid-item">
            <div class="card">';
        
        if (!empty($row["Imagen_Path"])) {
            echo '<a href="' . $row["Imagen_Path"] . '" target="_blank">
            <img src="' . $row["Imagen_Path"] . '" alt="Factura">
          </a>';
        } else {
            echo '<img src="https://static.vecteezy.com/system/resources/previews/023/259/597/original/file-type-or-format-is-not-supported-concept-illustration-flat-design-eps10-modern-graphic-element-for-landing-page-empty-state-ui-infographic-icon-vector.jpg" >'; // Imagen por defecto si no hay imagen_path
        }

        echo '<div class="card-body">
                    <p class="card-text negrita">Fecha de registro: </p>
                    <p class="card-text">' . $row["Fecha_Subida"] . '</p>

                    <p class="card-text negrita">Empresa emisora: </p>
                    <p class="card-text">' . $row["Empresa_Emisora"] . '</p>

                    <p class="card-text negrita">Producto: </p>
                    <p class="card-text ">' . $row["Nombre_Producto"] . '</p>

                    <p class="card-text negrita">Total: </p>
                    <p class="card-text">' . $row["Total_Compra"] . '</p>

                    <p class="card-text negrita">Cambio: </p>
                    <p class="card-text">' . $row["Cambio"] . '</p>

                    <p class="card-text negrita">Subtotal: </p>
                    <p class="card-text">' . $row["Subtotal"] . '</p>

                    <p class="card-text negrita">Impuesto: </p>
                    <p class="card-text">' . $row["Impuesto"] . '</p>

                    <p class="card-text negrita">Numero de serie: </p>
                    <p class="card-text">' . $row["Numero_Factura"] . '</p>

                    <p class="card-text negrita">Dirección: </p>
                    <p class="card-text">' . $row["Direccion"] . '</p>

                    <div class="modal fade" id="updateModal' . $row["Factura_ID"] . '" tabindex="-1" aria-labelledby="updateModalLabel' . $row["Factura_ID"] . '" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel' . $row["Factura_ID"] . '">Actualizar Factura</h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="./IMAGENES/cerca.png" alt="" style="width: 40px; height:40px"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="update_factura.php">
                                        <input type="hidden" name="factura_id" value="' . $row["Factura_ID"] . '">
                                        <div class="mb-3">
                                            <label for="empresa_emisora" class="form-label">Empresa Emisora</label> <br>
                                            <input type="text" class="form-control" name="empresa_emisora" value="' . $row["Empresa_Emisora"] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fecha_subida" class="form-label">Fecha Subida</label><br>
                                            <input type="text" class="form-control" name="fecha_subida" value="' . $row["Fecha_Subida"] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nombre_producto" class="form-label">Nombre Producto</label><br>
                                            <input type="text" class="form-control" name="nombre_producto" value="' . $row["Nombre_Producto"] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="total_producto" class="form-label">Total Producto</label><br>
                                            <input type="text" class="form-control" name="total_producto" value="' . $row["Total_Producto"] . '">
                                        </div>

                                        <div class="mb-3">
                                            <label for="total_compra" class="form-label">Total Compra</label><br>
                                            <input type="text" class="form-control" name="total_compra" value="' . $row["Total_Compra"] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="cambio" class="form-label">Cambio</label><br>
                                            <input type="text" class="form-control" name="cambio" value="' . $row["Cambio"] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="subtotal" class="form-label">Subtotal</label><br>
                                            <input type="text" class="form-control" name="subtotal" value="' . $row["Subtotal"] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="impuesto" class="form-label">Impuesto</label><br>
                                            <input type="text" class="form-control" name="impuesto" value="' . $row["Impuesto"] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="numero_factura" class="form-label">Número Factura</label><br>
                                            <input type="text" class="form-control" name="numero_factura" value="' . $row["Numero_Factura"] . '">
                                        </div>
                                        <div class="mb-3">
                                            <label for="direccion" class="form-label">Dirección</label><br>
                                            <input type="text" class="form-control" name="direccion" value="' . $row["Direccion"] . '">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
                         <div class="botones">
                            <form method="POST" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar esta factura?\');">
                                <input type="hidden" name="delete_id" value="' . $row["Factura_ID"] . '">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            <button type="button" class="btn btn-primary update-btn" data-bs-toggle="modal" data-bs-target="#updateModal' . $row["Factura_ID"] . '">
                                Actualizar
                            </button>
                    </div>

        </div>';
    }
    echo '</div>';
} 
else {
    echo "No hay facturas.";
}

$con->close();
?>

<script>
// Función para asociar eventos a los botones
function attachModalEvents() {
    // Obtener los botones que abren el modal
    var btns = document.querySelectorAll(".update-btn");

    // Cuando el usuario hace clic en el botón, abre el modal correspondiente
    btns.forEach(function(btn) {
        btn.onclick = function() {
            var modalId = btn.getAttribute("data-bs-target");
            var modal = document.querySelector(modalId);
            if (modal) {
                modal.style.display = "block";
            }
        };
    });

    // Cuando el usuario hace clic en <span> (x), cierra el modal
    document.querySelectorAll(".btn-close").forEach(function(span) {
        span.onclick = function() {
            var modal = span.closest(".modal");
            if (modal) {
                modal.style.display = "none";
            }
        };
    });

    // Cuando el usuario hace clic en cualquier lugar fuera del modal, lo cierra
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = "none";
        }
    };
}

// Llamar a attachModalEvents inicialmente para asociar eventos a los elementos existentes
attachModalEvents();

// Escuchar el evento personalizado emitido después de la actualización del contenido
document.getElementById('invoiceCards').addEventListener('contentUpdated', attachModalEvents);
</script>



