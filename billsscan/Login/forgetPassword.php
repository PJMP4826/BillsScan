<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvide mi contraseña - BillsScan</title>
    <link href="./css/fonts.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/jquery-1.7.2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#Myform').on('submit', function(event) {
                event.preventDefault(); // Evita el envío inmediato del formulario

                // Obtener los datos del formulario
                var formData = $(this).serialize();

                // Enviar los datos al servidor para validar y actualizar la contraseña
                $.ajax({
                    url: 'forgetProcess.php', // Archivo PHP para validar y actualizar la contraseña
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            // Mostrar alerta de éxito
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Contraseña cambiada exitosamente',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                // Redirigir o actualizar la página
                                window.location.href = 'login.php';
                            });
                        } else {
                            // Mostrar alerta de error
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al procesar la solicitud. Inténtalo de nuevo.'
                        });
                    }
                });
            });
        });

        function HideError() {
            document.getElementById('error').innerHTML = '';
        }
    </script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../image/imagen_login.jpg');
            background-size: cover;
            background-position: center;
        }

        .container {
            display: flex;
            width: 40%;

        }

        .left {
            flex: 1;
            background-color: #1e3a8a;
            padding: 30px;
            box-sizing: border-box;
            border-radius: 16px;

        }

        .right {
            flex: 1;
            background-color: #1e3a8a;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            padding: 30px;
            box-sizing: border-box;
        }

        .logo {
            display: block;
            margin: 0 auto;
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .google-button {
            display: flex;
            justify-content: center;
            background-color: white;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 100px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .google-button:hover {
            transform: scale(1.03);
        }

        .google-button a {
            display: flex;
            width: 100%;
            justify-content: center;
            background-color: white;
            color: black;
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 0;
            text-decoration: none;

            display: flex;
            align-items: center;
        }

        .google-button img {
            width: 40px;
            height: 40px;
            margin: 0 10px 0 0;
        }


        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: white;
            font-family: 'Jost';
        }

        .input-group input {
            width: 96%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 14px;
        }

        .btn {
            display: flex;
            justify-content: center;
            width: 100%;
            background-color: #C29A3D;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 20px;
            border-radius: 14px;
            cursor: pointer;
            font-family: 'Jost';
            font-weight: 500;
            text-decoration: none;
        }

        .btn a {
            text-decoration: none;
            color: white;
        }

        .btn:hover {
            transform: scale(1.04);
        }

        .footer {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            text-align: center;
            margin-top: 24px;


        }

        .footer .boton_registro {
            width: 40%;
        }

        .footer .boton_registro a {
            font-family: 'Jost';
            font-weight: 500;
            font-size: 20px;
            color: #7696ee;
            text-decoration: none;
        }

        .footer .boton_registro:hover {
            transform: scale(1.04);
        }

        .footer .boton_registro a:hover {
            text-decoration: underline;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .logo h2 {
            font-family: 'Jost';
            font-size: 60px;
            margin: 0;
            color: white;
        }

        .logo img {
            width: auto;
            height: 100px;
            margin: 0 12px 0 0;
        }

        .botones {
            width: 96%;
        }

        .lab {
            display: flex;
            justify-content: center;
            color: white;
            font-size: 20px;

        }



        @media (max-width: 1200px) {
            .container {
                width: 60%;
            }

            .title {
                font-size: 22px;
            }

            .btn {
                font-size: 18px;
            }
        }

        @media (max-width: 992px) {
            .container {
                width: 70%;
            }

            .title {
                font-size: 20px;
            }

            .btn {
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .container {
                width: 80%;
                flex-direction: column;
            }

            .left,
            .right {
                width: 100%;
                border-radius: 0;

            }

            .right {
                padding: 20px;
            }

            .google-button {
                font-size: 14px;
                padding: 8px 16px;
            }

            .btn {
                font-size: 16px;
                padding: 8px;
            }

            .footer .boton_registro {
                width: 60%;
            }
        }

        @media (max-width: 576px) {

            .left {
                width: 300px;
                border-radius: 12px;
            }

            .container {
                display: flex;
                width: 100%;
                align-items: center;
                justify-content: center;
            }

            .google-button {
                font-size: 12px;
                padding: 6px 12px;
            }

            .btn {
                font-size: 14px;
                padding: 6px;
            }

            .footer .boton_registro {
                width: 80%;
            }

            .logo h2 {
                font-size: 40px;
            }

            .logo img {
                height: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="logo">
                <img src="../image/Logo.BillsScan.png" alt="BillsScan Logo" class="logo" width="100"> <!-- Update logo source -->
                <h2 class="title">BillsScan</h2>
            </div>
            
            <form name="Myform" id="Myform" action="forgetProcess.php" method="post">
                <div id="error" style="color:red; font-size:16px; font-weight:bold; padding:5px"></div>

                <label for="" style="font-family: 'Jost';" class="lab">Rellena los datos</label>

                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="text" name="fname" id="fname" onkeydown="HideError()">
                </div>

                <div class="input-group">
                    <label for="email">Telefono</label>
                    <input type="text" name="mobile" id="mobile" onkeydown="HideError()">
                </div>

                <div class="input-group">
                    <label for="current_password">Contraseña Actual</label>
                    <input type="password" name="current_password" id="current_password" maxlength="8" onkeydown="HideError()">
                </div>

                <div class="input-group">
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" name="password" id="password" maxlength="8" onkeydown="HideError()" size="20px;">
                </div>

                <div>
                    <input type="submit" name="submit" value="Cambiar Contraseña" class="btn" style="margin-bottom: 20px;" />    
                </div>
                
                <div class="botones">
                    <a href="login.php" class="btn"><< Volver</a>
                </div>
                
            </form>
            
        </div>
    </div>
</body>

</html>