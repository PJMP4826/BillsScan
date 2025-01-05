<?php
// Inicia la sesión si no está iniciada
session_start();

// Conectar a la base de datos
include_once '../connection.php';


// Obtener los datos del formulario
$fname = $con->real_escape_string($_POST['fname']);
$lname = $con->real_escape_string($_POST['lname']);
$phone = $con->real_escape_string($_POST['phone']);
$email = $con->real_escape_string($_POST['email']);
$password = $con->real_escape_string($_POST['password']);
$type = $con->real_escape_string($_POST['type']);



// Insertar el nuevo empleado en la base de datos
$sql = "INSERT INTO user (fname, lname, phone, email, password, type) VALUES ('$fname', '$lname', '$phone', '$email', '$password', '$type')";

if ($con->query($sql) === TRUE) {
    // Redirigir con un mensaje de éxito
    header("Location: admin_usuarios.php?status=agregado");
} else {
    // Redirigir con un mensaje de error
    header("Location: admin_usuarios.php.php?status=error");
}

// Cerrar la conexión
$con->close();
?>
