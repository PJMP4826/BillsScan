<?php
session_start();
// Obtén el ID del usuario desde la sesión
$user_id = $_SESSION['id'];
// Conexión a la base de datos
include_once '../connection.php';

// Verificar la conexión
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directorio de carga
    $target_dir = "uploads/";

    // Verificar si el directorio existe y crearlo si no
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validación de archivo
    $errors = [];
    if ($_FILES["imagen"]["size"] > 50000000) {
        $errors[] = "El archivo es demasiado grande.";
    }

    $allowed_types = ["jpg", "png", "jpeg", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        $errors[] = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
    }

    // Si hay errores, salir
    if (!empty($errors)) {
        echo implode("<br>", $errors);
        exit();
    }

    // Mover el archivo a la ubicación final
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        // Insertar en la tabla facturas
        $sql = "INSERT INTO facturas_move (imagen_path) VALUES ('$target_file')";
        if ($con->query($sql) === TRUE) {
            $facturas_move_id = $con->insert_id;
    

            // Insertar en la tabla archivos_recientes
            $sql = "INSERT INTO archivos_recientes (facturas_move_id,user_id) VALUES ('$facturas_move_id','$user_id')";
            if ($con->query($sql) === TRUE) {
                echo "La factura se ha subido y registrado correctamente.";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        echo "Hubo un error al cargar su archivo.";
    }
}
?>