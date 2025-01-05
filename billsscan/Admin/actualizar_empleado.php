<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    include_once '../connection.php';


    // Actualizar el usuario con los datos proporcionados
    $sql = "UPDATE user SET fname='$fname', lname='$lname', phone='$phone', email='$email', `password`='$password', `type`='$type' WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        // Redirigir con éxito
        header("Location: admin_usuarios.php?status=actualizado");
    } else {
        // Redirigir con error
        header("Location: admin_usuarios.php?status=error");
    }

    // Cerrar la conexión
    $con->close();
    exit;
} else {
    echo "Datos no válidos.";
}
?>
