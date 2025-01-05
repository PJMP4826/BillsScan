<?php require('../layout/plantilla.php') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .contact-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .contact-info div {
            margin: 10px 0;
            text-align: center;
        }
        .contact-info a {
            color: #007bff;
            text-decoration: none;
        }
        .contact-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Información de Contacto</h1>
        <div class="contact-info">
            <div>
                <strong>Teléfono:</strong> <a href="tel:+1234567890">+9932215164</a>
            </div>
            <div>
                <strong>Correo Electrónico:</strong> <a href="https://mail.google.com/mail/?view=cm&fs=1&admin@gmail.com">admin@gmail.com</a>
            </div>
            <div>
                <strong>WhatsApp:</strong> <a href="https://wa.me/9932215164" target="_blank">Envíanos un mensaje en WhatsApp</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php require('../layout/cierre_plantilla.php') ?>