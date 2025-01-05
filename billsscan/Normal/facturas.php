<?php require('../layout/plantilla.php') ?>
<?php
$marca = isset($_GET['marca']) ? urldecode($_GET['marca']) : '';

?>
<div class="contenedor_facturas">
    <div class="facturas">
        <section id="invoices">
            <div class="priori">
                <h2 class="h2_facturas">Tickets</h2>
                <div class="">
                    <input type="text" class="buscadorr" id="searchInput" placeholder="Buscar..." onkeyup="searchInvoices()">
                    <input type="date" id="startDate" class="buscadorr" placeholder="Fecha inicio">
                    <input type="date" id="endDate" class="buscadorr" placeholder="Fecha fin">
                    <input type="time" id="startTime" class="buscadorr" placeholder="Hora inicio">
                    <input type="time" id="endTime" class="buscadorr" placeholder="Hora fin">
                    <select id="monthSelect" class="buscadorr">
                        <option value="">Seleccionar mes</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                    <button onclick="searchInvoices()">Buscar</button>
                </div>
            </div>
            
            <div class="scroll-container" id="invoiceCards">
                <?php include 'get_invoices.php'; ?>
            </div>
        </section>
    </div>
</div>



<style>
 .grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Tres columnas de igual ancho */
    gap: 16px;
    padding: 16px;
}

.grid-item {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 910px;
}

.card img {
    width: 100%;
    height: 410px; /* Ajusta la altura de la imagen automáticamente */
    object-fit: cover;

}

.card-body {
    padding: 0 16px;
    max-height: 660px;
    margin-bottom: 20px; /* Ajuste del padding para que el contenido se vea bien */
}

.card-title {
    font-size: 1.25em;
    margin: 0 0 8px 0;
}

.card-text {
    font-size: 0.9em;
    color: #666;
    margin-top: 0;
    margin-bottom: 4px;
}

.contenedor_facturas{
    width: 100%;
    display: flex;
    justify-content: center;
}

.facturas{
    width: 90%;
    

}

.form-control{
    padding: 7px;
    width: 500px;
    border: none;
    height:27px;
    border-radius: 8px;
    background-color: #D3D4D8;
    margin-bottom: 13px;
}
.buscadorr{
    padding: 7px;
    width: 400px;
    border: none;
    height:27px;
    border-radius: 8px;
    background-color: #D3D4D8;
    margin-bottom: 13px;
}

.scroll-container {
    max-height: 400px; /* Ajusta la altura según tus necesidades */
    overflow-y: scroll;
    padding: 16px;
    border: 1px solid #ddd;
}
.header{
    margin-bottom: 10px !important;
}
img{
    cursor: pointer;
}

@media screen and (min-width: 1420px) {
    .scroll-container {
    max-height: 600px; /* Ajusta la altura según tus necesidades */
    overflow-y: scroll;
    padding: 16px;
    border: 1px solid #ddd;
}
    }


    @media screen and (max-width: 916px) {
        input{
            width: 100px !important;
        }

        select{
            width: 100px !important;
        }

        option{
            width: 70px !important;
            height: auto;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(1, 1fr); /* Tres columnas de igual ancho */
            gap: 16px;
            padding: 16px;
        }

        .scroll-container{
            max-height: 510px;
        }
    }
</style>

<script>
function searchInvoices() {
    const input = document.getElementById('searchInput').value;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const mes = document.getElementById('monthSelect').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `get_invoices.php?search=${input}&start_date=${startDate}&end_date=${endDate}&mes=${mes}&start_time=${startTime}&end_time=${endTime}`, true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('invoiceCards').innerHTML = this.responseText;
            const event = new Event('contentUpdated');
            document.getElementById('invoiceCards').dispatchEvent(event);
        }
    }
    xhr.send();
}

function deleteInvoice(id) {
    if (confirm('¿Está seguro que desea eliminar esta factura?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_invoice.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                alert(this.responseText);
                searchInvoices(); // Refrescar la lista de facturas después de eliminar
            }
        }
        xhr.send('id=' + id);
    }
}

// Añadimos un listener para buscar cuando se cambia el mes
document.getElementById('monthSelect').addEventListener('change', searchInvoices);
</script>

<?php require('../layout/cierre_plantilla.php') ?>
