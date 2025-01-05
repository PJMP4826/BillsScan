<?php
include_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = htmlentities(stripslashes(mysqli_real_escape_string($con, $_POST['uname'])));
    $password = htmlentities(stripslashes(mysqli_real_escape_string($con, $_POST['password'])));

    // Usar sentencias preparadas para evitar inyecciones SQL
    $stmt = $con->prepare("SELECT * FROM user WHERE email = ? AND password = ? ");
    $stmt->bind_param('ss', $uname, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario y contraseña correctos
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['type'] = $row['type'];

        echo json_encode(['status' => 'success', 'type' => $row['type']]);
    } else {
        // Usuario o contraseña incorrectos
        echo json_encode(['status' => 'error', 'message' => 'Correo electrónico o contraseña incorrectos']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Solicitud no válida']);
}

$con->close();
?>
