<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.3/sweetalert2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.3/sweetalert2.min.js"></script> 
    <title>Login - BillsScan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../image/imagen_login.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Jost';
        }

        .login-container {
            background-color: #1A3E88;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 500px;
            z-index: 1;
        }

        .login-container h1 {
            color: #FFFFFF;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-container label {
            color: #FFFFFF;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 94%;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 13px;
        }

        .login-container .button {
            width: 100%;
            padding: 15px;
            background-color: #D6A446;
            color: #FFFFFF;
            border: none;
            border-radius: 13px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container .button:hover {
            background-color: #B89335;
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
    </style>
</head>
<body>
    <div class="login-container">
    <div class="logo">
        <img src="../image/Logo.BillsScan.png" alt="BillsScan Logo" class="logo" width="100">
        <h2 class="title">BillsScan</h2>
     </div>
        <form name="Myform" id="Myform" action="loginProcess.php" method="POST">
            <label for="email">Correo Electrónico</label>
            <input type="text" name="uname" id="uname" onkeydown="HideError()">
            
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" onkeydown="HideError()">
            
            <input class="btn button" type="submit" name="submit" value="Ingresar" />

        </form>
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
                                position: 'center',
                                icon: 'success',
                                title: 'Inicio de sesión exitoso',
                                showConfirmButton: false,
                                timer: 1500,
                                didOpen: () => {
                                    Swal.getPopup().style.zIndex = '100000000';
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
