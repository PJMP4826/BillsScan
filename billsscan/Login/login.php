<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../image/Logo.BillsScan.png" class="icono_pestaña">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.3/sweetalert2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.3/sweetalert2.min.js"></script> 
</head>

<body>
  
    <style>
        body {
            font-family: 'Jost';
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #f2f2f2, #e0e0e0);
            background-image: url('../image/imagen_login.jpg');/* Reemplaza con tu imagen */
            background-size: cover;
        }

        .container {
            position: relative;
            display: flex;
            background-color: #1A3E88;
            border-radius: 17px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            width: 500px;
        }

        .login-container img {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
        }

        .logo {
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;

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

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .iniciar_sesion {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        input {
            padding: 10px;
            width: 400px;
            border: none;
            background-color: white;
        }

        label {
            color: #FFFFFF;
            font-weight: bold;
            display: block;
        }

        .correo, .password{
            border-radius: 12px;
            padding: 15px;
        }

        input:focus {
            outline: none;
        }

        p {
            font-family: sans-serif;
        }

        .redireccionar {
            font-family: sans-serif;
        }

        .enviar {
            background-color: #D6A446;;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            width: 100%;
            font-family: 'Jost';
            font-size: 20px;
        }

        .enviar:hover {
            background-color: #B89335;
        }


        @media screen and (max-width: 916px) {
            body {
                padding: 20px; 
                width: auto;
                max-height: 915px !important;
            
            }

            .container {
                width: 100%; /* Ocupa todo el ancho disponible */
                padding: 20px; 
                display: flex;
                justify-content: center;
            }

            input {
                width: 86%; /* Ocupa todo el ancho disponible */
            }

            .logo h2 {
                font-size: 40px; /* Reduce el tamaño del logo */
            }
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="right">
        <div class="logo">
        <img src="../image/Logo.BillsScan.png" alt="BillsScan Logo" class="logo" width="100">
        <h2 class="title">BillsScan</h2>
     </div>
         
            <form name="Myform" id="Myform" method="POST" action="loginProcess.php">
               <div id="error" style="color:red; font-size:16px; font-weight:bold; padding:5px"></div>
               <label for="email">Correo Electrónico</label>
                <input type="email" name="uname" id="correo" required  onkeydown="HideError()" class="correo">
                
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="contraseña" onkeydown="HideError()" class="password">
                <input class="enviar" type="submit" name="submit" value="Ingresar" />
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#Myform').on('submit', function(event) {
                event.preventDefault(); // Evita el envío inmediato del formulario

                // Obtener los datos del formulario
                var formData = $(this).serialize();

                // Enviar los datos al servidor para validar el inicio de sesión
                $.ajax({
                    url: 'loginProcess.php', // Archivo PHP para validar el inicio de sesión
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        var result = JSON.parse(response);

                        if (result.status === 'success') {
                            // Mostrar alerta de éxito
                            Swal.fire({
                                position: 'center', // Asegura que la alerta esté centrada en la pantalla
                                icon: 'success', // Tipo de alerta (éxito)
                                title: 'Inicio de sesión exitoso', // Título de la alerta
                                showConfirmButton: false, // Oculta el botón de confirmación
                                timer: 1500, // Duración de la alerta en milisegundos
                                didOpen: () => {
                                    // Opcional: Realiza alguna acción cuando se abre la alerta
                                    Swal.getPopup().style.zIndex = '10000'; // Asegura que la alerta esté sobre otros elementos
                                }
                            }).then(function() {
                                // Redirigir según el tipo de usuario
                                if (result.type === 'Admin') {
                                    window.location.href = '../Admin/index_admin.php';
                                } else if (result.type === 'Normal') {
                                    window.location.href = '../Normal/index.php';
                                }
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
    
</body>

</html>

