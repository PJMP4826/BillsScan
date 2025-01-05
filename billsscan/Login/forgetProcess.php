<?php
include_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = htmlentities(stripslashes(mysqli_real_escape_string($con, $_POST['mobile'])));
    $email = htmlentities(stripslashes(mysqli_real_escape_string($con, $_POST['fname'])));
    $current_password = htmlentities(stripslashes(mysqli_real_escape_string($con, $_POST['current_password'])));
    $new_password = htmlentities(stripslashes(mysqli_real_escape_string($con, $_POST['password'])));

    // Usar sentencias preparadas para evitar inyecciones SQL
    $stmt = $con->prepare("SELECT * FROM user WHERE phone = ? AND email = ? AND password = ?");
    $stmt->bind_param('sss', $phone, $email, $current_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Contraseña actual es correcta, proceder a actualizarla
        $stmt = $con->prepare("UPDATE user SET password = ? WHERE phone = ? AND email = ?");
        $stmt->bind_param('sss', $new_password, $phone, $email);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la contraseña']);
        }
    } else {
        // Contraseña actual es incorrecta
        echo json_encode(['status' => 'error', 'message' => 'La contraseña actual es incorrecta']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Solicitud no válida']);
}
$con->close();
?>
