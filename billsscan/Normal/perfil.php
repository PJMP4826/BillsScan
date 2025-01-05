<?php require('../layout/plantilla.php'); ?>

<?php

$user_id = $_SESSION['id'] ?? null;
if (!$user_id) {
    die("Usuario no autenticado.");
}

// Conectar a la base de datos usando MySQLi
include_once '../connection.php';


// Manejar la subida de archivo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
    $file = $_FILES['foto_perfil'];
    $target_dir = "foto_perfil/"; // Directorio donde se guardarán las imágenes
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
        $error = "El archivo no es una imagen.";
    }

    // Verificar tamaño del archivo
    if ($file["size"] > 500000) {
        $uploadOk = 0;
        $error = "Lo siento, el archivo es demasiado grande.";
    }

    // Verificar tipo de archivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
        $error = "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
    }

    // Verificar si $uploadOk es 0 por un error
    if ($uploadOk == 0) {
        $error = "Lo siento, tu archivo no se subió.";
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            // Actualizar la base de datos con la nueva ruta de la imagen
            $updateQuery = "UPDATE user SET foto_perfil = ? WHERE id = ?";
            $stmt = $con->prepare($updateQuery);
            $stmt->bind_param("si", $target_file, $user_id);
            $stmt->execute();
            $stmt->close();
            
            // Actualizar la página solo si la subida es exitosa
            echo "<script>window.location.href = window.location.pathname;</script>";
        } else {
            $error = "Lo siento, hubo un error al subir tu archivo.";
        }
    }
}

// Obtener información del usuario desde la base de datos
$query = "SELECT fname, lname, phone, email, type, foto_perfil FROM user WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if (!$userData) {
    die("Usuario no encontrado.");
}

$stmt->close();
$con->close();
?>

<style>
    .w1 {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .profile-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 350px;
        padding: 20px;
        text-align: center;
    }
    .profile-card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
    }
    .profile-card h2 {
        margin: 12px 0 0 0 ;
        color: #333;
    }
    .profile-card p {
        color: #666;
        margin: 5px 0;
    }
    .profile-card .profile-info {
        text-align: left;
        margin-top: 15px;
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    .profile-card .profile-info p {
        margin: 5px 0;
    }
    .upload-btn-wrapper {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .file-input {
        display: none; /* Ocultar el campo de archivo */
    }
    .file-label {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 6px 12px;
        background-color: #f8f9fa;
        cursor: pointer;
        color: #333;
        font-size: 14px;
        transition: background-color 0.3s, border-color 0.3s;
        display: inline-block;
    }
    .file-label:hover {
        background-color: #e2e6ea;
        border-color: #007bff;
    }
    .btn-submit {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 6px 12px;
        cursor: pointer;
        background-color: #007bff;
        color: white;
        font-size: 14px;
        margin-top: 10px;
        transition: background-color 0.3s, border-color 0.3s;
    }
    .btn-submit:hover {
        background-color: #0056b3;
    }
</style>

</head>
<body>

<div class="w1">
    <div class="profile-card">
        <img src="<?php echo htmlspecialchars($userData['foto_perfil']) ?: 'https://via.placeholder.com/100'; ?>" alt="Foto de perfil">
        <form method="POST" enctype="multipart/form-data">
            <div class="upload-btn-wrapper">
                <label class="file-label">
                    <input type="file" name="foto_perfil" accept="image/*" class="file-input">
                    Selecciona una imagen
                </label>
                <input type="submit" value="Subir Imagen" class="btn-submit">
            </div>
        </form>
        <h2><?php echo htmlspecialchars($userData['fname'] . ' ' . $userData['lname']); ?></h2>

        <div class="profile-info">
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($userData['phone']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
        </div>
    </div>
</div>

<?php require('../layout/cierre_plantilla.php'); ?>
