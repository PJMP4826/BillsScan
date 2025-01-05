<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BillsScan</title>
    <link href="../css/login.css" rel="stylesheet">
    <script src="../js/jquery-1.7.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <div class="left">
            <div class="logo">
                <img src="../image/Logo.BillsScan.png" alt="BillsScan Logo" class="logo" width="100">
                <h2 class="title">BillsScan</h2>
            </div>
            <form name="Myform" id="Myform" action="loginProcess.php" method="post">
                <div id="error" style="color:red; font-size:16px; font-weight:bold; padding:5px"></div>

                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="text" name="uname" id="uname" onkeydown="HideError()">
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" onkeydown="HideError()">
                </div>
                <div>
                    <input class="btn" type="submit" name="submit" value="Ingresar" />
                </div>
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

    <style>
        .input-group input {
            width: 95.5%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 14px;
        }
    </style>
</body>

</html>
