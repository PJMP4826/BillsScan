<?php require('../layout/plantilla_admin.php') ?>

<?php include_once 'AdminSession.php';

$uname = $_SESSION['email'];
$password = $_SESSION['password'];
$chekUser = mysqli_query($con, "Select * from user where email= '$uname' AND password = '$password'") or die(mysqli_error($con));
$row = mysqli_fetch_array($chekUser);
$fname = $row['fname'];
$lname = $row['lname'];

$username = $fname . " " . $lname;
?>
<div class="contenedor_1">
    <div class="subir">
        <img src="../image/iconos/SUBIR.svg" alt=Subir Archivos" class="subir_ico">
        <form id="formulario1" action="consulta.php" method="post" enctype="multipart/form-data" style="display: inline;">
            <input type="file" id="imagen" name="imagen" accept=".jpg, .jpeg">
            <br>
            <input type="submit" value="Enviar" class="upload-button">

        </form>
    </div>


    <script>
        function mostrarImagen() {
            const imagenInput = document.querySelector("#imagen")
            const imagenPrevioContainer = document.querySelector("#imagenPrevioContainer")
            const imagenPrevio = document.querySelector("#imagenPrevio")

            const resultadoPre = document.querySelector("#resultado")

            if (imagenInput.files && imagenInput.files[0]) {
                const reader = new FileReader()

                reader.onload = function(e) {
                    imagenPrevio.src = e.target.result
                    // Mostrar el div de la imagen cuando se selecciona una imagen
                    imagenPrevioContainer.style.display = "block";
                    // Borrar el contenido del textarea y del resultado
                    consultaTextarea.value = ""
                    resultadoPre.innerHTML = ""
                };

                reader.readAsDataURL(imagenInput.files[0])
            } else {
                // Ocultar el div de la imagen cuando no se selecciona una imagen
                imagenPrevioContainer.style.display = "none"
            }
        }
        const formulario1 = document.querySelector("#formulario1")
        document.querySelector("#imagen").addEventListener("change", () => {
            mostrarImagen()
        })

        function escaparCaracteresHTML(texto) {
            return texto.replace(/</g, '&lt;').replace(/>/g, '&gt;')
        }


        formulario1.addEventListener("submit", evento => {
            evento.preventDefault()


            const imagenInput = document.querySelector("#imagen")
            const imagen = imagenInput.files[0]

            const botonConsultar = document.querySelector("input[type='submit']")
            botonConsultar.disabled = true
            botonConsultar.value = "Escaneando..."

            const datosFormulario = new FormData()

            datosFormulario.append("imagen", imagen)

            fetch("consulta.php", {
                    method: 'POST',
                    body: datosFormulario
                }).then(respuesta => respuesta.json())
                .then(respuesta => {
                    console.log(respuesta.mensaje)
                    document.querySelector("#resultado").innerHTML = `${escaparCaracteresHTML(respuesta.mensaje)}<br>`
                    botonConsultar.disabled = false
                    botonConsultar.value = "Enviar"
                })
                .catch(error => {
                    console.error('Error en la solicitud fetch:', error)
                    botonConsultar.disabled = false
                    botonConsultar.value = "Enviar"
                });


            // Enviar al segundo archivo PHP
            fetch("upload_invoice.php", {
                    method: 'POST',
                    body: datosFormulario
                }).then(respuesta => respuesta.json())
                .then(respuesta => {
                    console.log("Enviado a upload_invoice.php:", respuesta.mensaje);
                    document.querySelector("#resultado").innerHTML += `${escaparCaracteresHTML(respuesta.mensaje)}<br>`;
                }).catch(error => {
                    console.error('Error en la solicitud fetch:', error);
                });
        });
    </script>

<style>
    @media screen and (max-width: 1368px) {
        .funcion {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 17px 10px;
            border-radius: 16px;
            justify-content: center;
            width: 450px !important;
            height: 160px !important;
            background-color: white;
            flex-direction: column;
            border: none;
            transition: 0.6s;
        }

        .funcion:hover{
            transform: scale(1.08);
        }

       

        .generar_excel{
            width: 300px;
            height: 150px;
            position: absolute;
            opacity: 0;
            left: 830px;
            top: 130px;
            z-index: 1000;

        }


        .subir {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .icon-containerr {
            right: 70%;
            width: 40px;
            height: 40px;
            background-color: #cda62f;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .titulo_h2 {
            font-size: 20px;
            font-family: 'Jost';
            margin-bottom: 3px !important;
            width: 200px;
            cursor: pointer;
            z-index: 0;
        }

        .icon-container:hover {
            transform: none;
        }

        #imagen {
            position: absolute;
            top: 197px;
            left: 450px;
            transform: scale(2.2);
            opacity: 0;
            width: 50px;
        }

        .subir_ico {
            margin-bottom: 0;
            width: 170px !important;
            height: auto;


        }

        .label_subir {

            background-color: #C2993B;
            padding: 10px;
            border-radius: 20px;
            text-align: center;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            width: 300px;

        }


        .upload-button {
            background-color: #C2993B;
            border: none;
            padding: 10px;
            border-radius: 20px;
            text-align: center;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            width: 300px;

        }

        .elegir_archivos {
            z-index: 1000;
            position: absolute;
            top: 0;
            left: 0;
            width: 27%;
            height: 20%;
            opacity: 0;
            margin-top: 150px;
            margin-left: 259px;
            cursor: pointer;
        }

        .archivos_recientes {
            width: 100%;
            height: auto
        }

        .files {
            display: flex;
            overflow-x: auto;
            width: 100%;
            height: 300px;
            scroll-behavior: smooth;
            padding-bottom: 20px;
        }

        .files img {
            flex: 0 0 auto;
            height: 100%;
            transition: border 0.3s ease;
            margin-right: 10px;
        }

        .files img:last-child {
            margin-right: 0;
        }

        .files img:hover {
            border: 2px solid black;
        }

        /*Modal inicio  */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        /*Modal estilos final */
        .card {
            max-height: 400px;
            /* Ajusta la altura según tus necesidades */
            overflow-x: scroll;
            white-space: nowrap;
            padding: 16px;
            border: 1px solid #ddd;
        }

        .archivos_recientes {
            padding: 16px;
        }

        .scroll-horizontal {
            height: 200px;
            overflow-x: auto;
            white-space: nowrap;
            padding: 0 !important;
            border: none;
            margin: 0 !important;
            overflow-y: hidden;
        }
        .image-container {
            display: flex;
            height: 200px;
            gap: 16px;
            margin: 0 !important;
            padding: 0 !important;
        }

        .image-item {
            display: inline-block;
            background: #fff;
            min-width: 150px;
            /* Ajusta el ancho mínimo según tus necesidades */
            margin: 0 !important;
            height: 100%;
            padding: 0 !important;
        }

        .image-item img {
            width: 80%;
            height: 200px;
            margin: 0;
            object-fit: cover;
        }
    }
    



       
        @media screen and (min-width: 1420px) {
            .funcion {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 50px 10px;
            border-radius: 16px;
            justify-content: center;
            width: 650px !important;
            height: 180px !important;
            background-color: white;
            flex-direction: column;
            border: none;
            transition: 0.6s;
        }

        .funcion:hover{
            transform: scale(1.08);
        }

       

        .generar_excel{
            width: 300px;
            height: 150px;
            position: absolute;
            opacity: 0;
            left: 830px;
            top: 130px;
            z-index: 1000;

        }


        .subir {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 600px !important;

        }

        .icon-containerr {
            right: 70%;
            width: 40px;
            height: 40px;
            background-color: #cda62f;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .titulo_h2 {
            font-size: 20px;
            font-family: 'Jost';
            margin-bottom: 3px !important;
            width: 200px;
            cursor: pointer;
            z-index: 0;
        }

        .icon-container:hover {
            transform: none;
        }

        #imagen {
            position: absolute;
            top: 197px;
            left: 450px;
            transform: scale(2.2);
            opacity: 0;
            width: 50px;
        }

        .subir_ico {
            margin-bottom: 0;
            width: 170px !important;
            height: auto;


        }

        .label_subir {

            background-color: #C2993B;
            padding: 10px;
            border-radius: 20px;
            text-align: center;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            width: 300px;

        }


        .upload-button {
            background-color: #C2993B;
            border: none;
            padding: 10px;
            border-radius: 20px;
            text-align: center;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            width: 300px;

        }

        .elegir_archivos {
            z-index: 1000;
            position: absolute;
            top: 0;
            left: 0;
            width: 27%;
            height: 20%;
            opacity: 0;
            margin-top: 150px;
            margin-left: 259px;
            cursor: pointer;
        }

        .archivos_recientes {
            width: 100%;
            height: auto
        }

        .files {
            display: flex;
            overflow-x: auto;
            width: 100%;
            height: 300px;
            scroll-behavior: smooth;
            padding-bottom: 20px;
        }

        .files img {
            flex: 0 0 auto;
            height: 100%;
            transition: border 0.3s ease;
            margin-right: 10px;
        }

        .files img:last-child {
            margin-right: 0;
        }

        .files img:hover {
            border: 2px solid black;
        }

        /*Modal inicio  */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        /*Modal estilos final */
        .card {
            max-height: 400px;
            /* Ajusta la altura según tus necesidades */
            overflow-x: scroll;
            white-space: nowrap;
            padding: 16px;
            border: 1px solid #ddd;
        }

        .archivos_recientes {
            width: 650px !important;
            height: auto;
            margin-left: 100px !important;

        }

        

        .scroll-horizontal {
            height: 400px;
            overflow-x: auto;
            white-space: nowrap;
            padding: 0 !important;
            border: none;
            margin: 0 !important;
            overflow-y: hidden;
        }
        .image-container {
            display: flex;
            height: 400px;
            gap: 10px;
            margin: 0 !important;
            padding: 0 !important;
        }

        .image-item {
            display: inline-block;
            background: #fff;
            min-width: 150px;
            /* Ajusta el ancho mínimo según tus necesidades */
            margin: 0 !important;
            height: 100%;
            padding: 0 !important;
        }

        .image-item img {
            width: 80%;
            height: 400px;
            margin: 0;
            object-fit: cover;
        }

        .chart{
            width: 600px;
            margin-left: 100px;
        }

        .chart canvas{
            width: 580px;
          height: 450px !important;
        }
        }

        @media screen and (max-width: 916px) {
            .chart{
                display: none;

            }

          

            form input{
                top: 180px !important;
                left: 100px !important;
                height: 40px;
                width: auto;
            }

            #imagen{
                left: 130px !important;
                padding: 10px;
                max-height:10px ;
            }

            .contenedor_1{
                margin: 0 !important;
            }
            .content{
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 1000px;
                height: 800px;
            }

            .archivos_recientes {
            width: 330px !important;
            height: 200px;
            margin-left: 0 !important;

        }
        
        .funcion{
            width: 300px !important;
            height: auto;
        }
        

        .scroll-horizontal {
            height: 200px;
            overflow-x: auto;
            white-space: nowrap;
            padding: 0 !important;
            border: none;
            margin: 0 !important;
            overflow-y: hidden;
        }

        .header{
            max-height: 500px !important;
            margin-bottom: 20px !important;
        }
        }
    </style>

    <div class="sub_contenedor_1">
        <div class="sub_cont_dividido_1">
            <form action="generar_reporte.php"  method="post">
                <button class="funcion" type="submit" name="generar_reporte">
                    <img src="../Normal/IMAGENES/iconos/excel.svg" alt="Corregir Factura" class="icono_excel">
                    <h3 class="titulo_h2">Generar reporte Excel</h3>
                </button>

            </form>
        </div>
    </div>
</div>

<div class="dashboard">
    <div class="archivos_recientes">
        <h3>Archivos Recientes</h3>
        <div class="scroll-horizontal">

            <?php
            $user_id = $_SESSION['id'];
            // Conexión a la base de datos
            include_once '../connection.php';

            
            // Verificar la conexión
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
            
            $sql = "SELECT f.imagen_path FROM archivos_recientes as archir
                JOIN facturas_move f ON archir.facturas_move_id = f.id 
         
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

        </div>
    </div>

    <div class="chart">
        <h3>Tickets Procesados</h3>
        <canvas id="facturasChart" width="400" height="200"></canvas>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.onload = function() {
            fetch('obtener_datos_facturas.php')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => {
                        // Parseamos la fecha y ajustamos a la zona horaria local
                        let fecha = new Date(item.fecha);
                        // Aseguramos que la fecha sea ajustada para la zona horaria local
                        fecha = new Date(fecha.getTime() + (fecha.getTimezoneOffset() * 60000));
                        return fecha.toLocaleDateString('es-ES', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                    });
                    const values = data.map(item => item.cantidad_facturas);

                    const ctx = document.getElementById('facturasChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Tickets Procesados',
                                data: values,
                                backgroundColor: '##3e5a82',
                                borderColor: '#3e5a82',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Fecha'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Cantidad de tickets'
                                    }
                                }
                            }
                        }
                    });
                });
        };
    </script>



    <?php require('../layout/cierre_plantilla_admin.php') ?>