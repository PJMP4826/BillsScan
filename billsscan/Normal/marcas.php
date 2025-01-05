<?php require('../layout/plantilla.php') ?>

<style>
    .cabeza {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 10px 0;
    }

    .ruta {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 50%;
    }

    .ruta span {
        color: black;
        margin-bottom: 7px;
    }

    .ruta a {
        color: black;
    }

    .total_gastado {
        display: flex;
        flex-direction: column;
        background-color: #3e5a82;
        color: white;
        border-radius: 5px;
        justify-content: center;
        align-items: center;
        width: 36%;
    }

    .centrado {
        width: 87%;
        display: flex;
        justify-content: space-between;
    }

    .dashboard-path {
        font-size: 14px;
    }

    .dashboard-path span {
        color: black;
    }

    .dashboard-path a {
        color: black;
        text-decoration: none;
    }

    .buscador {
        flex: 1;
        display: flex;
        justify-content: center;
    }

    .search-bar {
        padding: 15px;
        border-radius: 14px;
        border: none;
        width: 100%;
        max-width: 200px;
        background-color: #D3D4D8;
    }



    .suma_total {
        background-color: #005f73;
        /* Cambiar a un color más oscuro para el contraste */
        color: white;
        /* Asegura que el texto sea visible */
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        min-width: 100px;
        /* Asegura que el ancho mínimo sea suficiente */
    }



    .filters {
        display: flex;
        gap: 10px;
    }

    .filter {
        background-color: #f0f0f0;
        padding: 8px 12px;
        border-radius: 20px;
        cursor: pointer;
    }

    .brand {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .brand-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 90%;
    }

    .brand-item {
        display: flex;
        align-items: center;
        background-color: #3e5a82;
        padding: 15px;
        border-radius: 10px;
        color: white;
        justify-content: space-between;
        height: 70px;
    }

    .colum {
        display: flex;
        flex-direction: column;
        color: white;
        font-family: sans-serif;
        justify-content: center;

        width: 20%;
        height: 40px;
    }

    .colum span {
        color: white;
    }

    .brand-logo {
        width: 50px;
        height: 50px;
        margin-right: 15px;
    }

    .brand-info {
        flex-grow: 1;
    }

    .brand-name {
        font-size: 20px;
        font-weight: bold;
    }

    .brand-files {
        font-size: 14px;
    }

    .brand-cost {
        text-align: right;
    }

    .brand-cost span {
        display: block;
    }

    .brand-update {
        font-size: 12px;
        color: #b0b0b0;
    }

    .contenedor-scroll {
        max-height: 400px;
        /* Ajusta la altura según tus necesidades */
        overflow-y: scroll;
        padding: 16px;
        border: none;
        width: 90%;
    }

    .pesos {
        color: black;
        font-family: sans-serif;
    }

    @media screen and (min-width: 1420px) {
        .contenedor-scroll {
        max-height: 800px;
        /* Ajusta la altura según tus necesidades */
        overflow-y: scroll;
        padding: 16px;
        border: none;
        width: 90%;
    }
    }

    @media screen and (max-width: 916px) {
        input{
            width: 130px !important;
        }

        .centrado .titulo_ruta{
            display: none;
        }

        .total_gastado{
            width: 200px !important;
        }

        .brand-item .brand-name{
            width: 100px !important;
        }


        .brand-item .colum{
            width: 200px !important;
            height: auto;
            display: flex;
            align-items: end;
            justify-content: center;
        }

        .brand-item .pesos{
            width: 160px !important;
        }

        .contenedor-scroll{
            max-height: 580px;
        }

        button{
            margin-left: 50px;
        }
    }
</style>

<div class="cabeza">
    <div class="centrado">
        <div class="ruta">
            <span class="titulo_ruta"><a href="./categorias.php" class="titulo_ruta">Categorías</a>>Compra de Productos</span>
            <input type="text" placeholder="Buscar por nombre" class="search-bar" id="searchInput" oninput="searchInvoices()">
        </div>

        <div class="total_gastado">
            <?php
            // Obtén el ID del usuario desde la sesión
            $user_id = $_SESSION['id'];
            include_once '../connection.php';

            // Consulta para el total gastado
            $sql1 = "SELECT SUM(total_compra) AS total_gastado FROM cambio as c
            inner join facturas as f on c.facturas_id=f.id
            inner join user as u on f.user_id=u.id
            where u.id=$user_id";
            $result1 = $con->query($sql1);
            $row1 = $result1->fetch_assoc();
            $total_gastado = $row1['total_gastado'];

            // Consulta para el total de facturas
            $sql2 = "SELECT COUNT(*) AS total_facturas FROM facturas as f
            inner join user as u on f.user_id=u.id
            where u.id=$user_id";
            $result2 = $con->query($sql2);
            $row2 = $result2->fetch_assoc();
            $total_facturas = $row2['total_facturas'];

            // Formateamos los totales
            $total_formateado = number_format($total_gastado, 2, ',', '.');
            $total_facturas_formateado = number_format($total_facturas, 0);

            // Mostramos los resultados
            echo '
            <span class="brand-name">Total Gastado: $' . $total_formateado . ' MXN</span>
            <span class="brand-name">No.Tickets: ' . $total_facturas_formateado .'</span>
            ';
            ?>
        </div>
    </div>
</div>

<div id="invoiceCards">
    <div class="contenedor-scroll">
        <div class="brand">
            <div class="brand-list">
                <?php
                // Consulta de marcas y facturas
                $search = isset($_GET['search']) ? $con->real_escape_string($_GET['search']) : '';
                $sql = "SELECT
                            SUBSTRING(denominacion_social, 1, 3) AS iniciales,
                            denominacion_social,
                            COUNT(*) AS total_facturas,
                            SUM(c.total_compra) AS total_compra
                        FROM
                            facturas f
                        INNER JOIN emisor e ON f.emisor_id = e.id
                        INNER JOIN cambio c ON f.id = c.facturas_id
                        inner join user as u on f.user_id=u.id
                        WHERE denominacion_social LIKE '%$search%' AND
                        u.id=$user_id
                        GROUP BY
                            SUBSTRING(denominacion_social, 1, 3), denominacion_social";
                $result = $con->query($sql);

                // Crear array de marcas
                $marcas = [];
                while ($row = $result->fetch_assoc()) {
                    $marcas[] = $row;
                }

                // Recorrer el array de marcas y generar HTML
                foreach ($marcas as $marca) {
                    echo '<a href="./facturas.php?marca=' . urlencode($marca['denominacion_social']) . '&search=' . urlencode($marca['denominacion_social']) . '">';
                    echo '<div class="brand-item">';
                    echo '<span class="brand-name">' . $marca['denominacion_social'] . '</span>';
                    echo '<div class="colum">';
                    echo ' <span class="pesos">' . number_format($marca['total_compra'], 2, ',', '.') . ' MXN</span> <span class="pesos">' . $marca['total_facturas'] . ' tickets</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    function searchInvoices() {
        const input = document.getElementById('searchInput').value;
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'marcas.php?search=' + input, true);
        xhr.onload = function() {
            if (this.status === 200) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(this.responseText, 'text/html');
                const newContent = doc.getElementById('invoiceCards').innerHTML;
                document.getElementById('invoiceCards').innerHTML = newContent;
            }
        }
        xhr.send();
    }
</script>

<?php
// Finalmente cerramos la conexión
$con->close();
?>

<?php require('../layout/cierre_plantilla.php') ?>