<?php

include_once 'NormalSession.php';
$uname = $_SESSION['email'];
$password = $_SESSION['password'];
$id=$_SESSION['id'];
$chekUser = mysqli_query($con, "Select * from user where email= '$uname' AND password = '$password'") or die(mysqli_error($con));
$row = mysqli_fetch_array($chekUser);
$fname = $row['fname'];
$lname = $row['lname'];
$user_id=$row['id'];

$username = $fname . " " . $lname;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./IMAGENES/Logo.BillsScan.png" class="icono_pestaña">
    <title>BillsScan</title>
   <link rel="stylesheet" href="../css/categorias_estilo.css">
   <link href="./css/fonts.css" rel="stylesheet">


   

   <!--Bootstarp-->
   <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"rel="stylesheet"integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"crossorigin="anonymous"/>-->
   

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <style>
    .header{
        margin: 0 0 40px 0;

    }
    .parteizquierda .aa {
    display: flex;
    align-items: center;
    padding: 15px 6px;
    margin: 7px 0;
    text-decoration: none;
    color: black;
    }
    
    .icon{
        margin-left: 16px !important;
    }
    
    .nombre_usuario{
        color: white !important;
        font-size: 20px;
        font-family: 'Jost' !important;
        z-index: 1000;
        margin-right: 5px;
    }
    .boton_cerrar_sesion{
        text-decoration: none;
        color: white;
        padding: 7px;
        background-color: #C2993B;
        border-radius: 7px;
        margin-right: 10px;
        font-family: 'Jost';
        z-index: 1000;
        margin-bottom: 12px;
    }
    .boton_cerrar_sesion:hover{
        transform: scale(1.06);
        z-index: 1000;
    }

    .sidebar .aa {
        width: 180px;
        height: 60px;
        margin-top: 10px !important;
        margin-bottom: 10px !important;
    }

    .boton_sidebar{
        display: none;
    }


    @media screen and (max-width: 480px) {

    /*Header */
    .header{
        width: 100%;
        border-radius: 0;
        

    }

    .boton_sidebar{
        display: block;
    }


    .header input{
        width: 100px;
        margin-left: 5px;
    }
    .header h2{
        font-size: 15px;
    }
    .header a{
        width:100px;
        font-size: 11px;
        font-family: 'Jost';
    }

        .sidebar {
        position: fixed;
        left: -200px; /* Oculto fuera de la vista */
        transition: left 0.3s ease-in-out;
        width: 200px;
        display: none;
        z-index: 9999;
        height: 100%; /* Asegura que esté encima de otros elementos */

        }

        .sidebar.sidebar-visible {
            left: 0; /* Sidebar visible */
        }

  

}

    .nombre_usuario:hover{
        transform: scale(1.1);
    }

    .user-info {
    position: relative;
    display: inline-block;
    }

  
    .submenu {
        display: none; /* Oculto por defecto */
        position: absolute; /* Posición absoluta respecto a .user-info */
        top: 100%; /* Despliegue justo debajo del ancla */
        left: 0;
        background-color: #C7C8CC;
        padding: 0;
        list-style: none;
        margin: 0;
        box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        min-width: 150px;
        z-index: 100;
        border-radius: 10px;
    }

    .submenu li a {
        color: black;
        text-decoration: none;
        padding: 10px;
        display: block;
        transition: background-color 0.2s;
    }

    .submenu li a:hover {
        background-color: #e0e0e0;
        border-radius: 10px;
    }

    .boton_cerrar_sesion {
        display: inline-block;
        text-decoration: none;
        font-weight: bold;
    }

    
   
    .nombre_usuario{
            width: 100px !important;
        }

        .toggle-menu{
            width: 100px !important;
        }

        h2{
            margin: 0;
            margin-left: 10px;
        }

        table{
            width: 370px;
        }

        .contenedor-scroll{
            max-height: 550px !important;
        }
   </style>

</head>
<body>

<?php
// Asegúrate de que la sesión esté iniciada

$user_id = $_SESSION['id'] ?? null;
if (!$user_id) {
    die("Usuario no autenticado.");
}

// Conectar a la base de datos usando MySQLi
include_once '../connection.php';


// Obtener información del usuario desde la base de datos
$query = "SELECT fname, lname, foto_perfil FROM user WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if (!$userData) {
    die("Usuario no encontrado.");
}

$stmt->close();

?>

    <section class="sec">
        <div class="sidebar">
            <img src="./IMAGENES/Logo.BillsScan.png" alt="BillsScan Logo" class="logo">
            <h1>BillsScan</h1>
            <a href="./index.php" class="aa"><img src="./IMAGENES/iconos/DASHBOARD.svg" alt="Dashboard Icon"  class="icon"> Dashboard</a>
            <a href="../Normal/facturas.php" class="aa"><img src="./IMAGENES/iconos/FACTURAS.svg" alt="Facturas Icon"    class="icon">Tickets</a>
            <a href="../Normal/marcas.php" class="aa"><img src="./IMAGENES/iconos/CATEGORIAS.svg" alt="Categorías Icon"class="icon"> Categorías</a>
            <a href="../Normal/historial.php" class="aa"><img src="./IMAGENES/iconos/HISTORIAL.svg" alt="Historial Icon"  class="icon"> Historial</a>
            <a href="../Normal/mensajes.php" class="aa ayuda"><img src="../image/iconos/ayuda.png" alt="Ayuda Icon"  class="icon"> Ayuda</a>
        </div>
       
        <div class="content">
        <div class="header" id="navMenu">

        <button id="toggleSidebarBtn" class="boton_sidebar">☰</button>
    <div class="buscador">
        <!--<input type="text" placeholder="Buscar...">-->
    </div>
    
    <div class="user-info">
        <a href="#" class="toggle-menu">
            <h2 class="nombre_usuario"><?php echo htmlspecialchars($userData['fname']." ".$userData['lname']); ?></h2>
        </a>
        <!-- Menú desplegable -->
        <ul class="submenu">
            <li><a href="../Normal/perfil.php">Perfil</a></li>
        </ul>
        <!-- Botón de cerrar sesión -->
        <img src="<?php echo htmlspecialchars($userData['foto_perfil']) ?: 'https://via.placeholder.com/100'; ?>" alt="Foto de perfil" class="foto-perfil">
        <a href="../logout.php" class="boton_cerrar_sesion" style="margin-left: 12px;">Cerrar Sesión</a>
     </div>
</div>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                const toggleMenu = document.querySelector('.toggle-menu');
                const submenu = document.querySelector('.submenu');

                // Alternar visibilidad del menú al hacer clic en el enlace
                toggleMenu.addEventListener('click', function(event) {
                    event.preventDefault(); // Evitar que el enlace navegue
                    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                });

                // Ocultar el menú si se hace clic fuera de él
                document.addEventListener('click', function(event) {
                    if (!toggleMenu.contains(event.target) && !submenu.contains(event.target)) {
                        submenu.style.display = 'none';
                    }
                });
            });
            </script>

            <script>
  document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');

    toggleSidebarBtn.addEventListener('click', function() {
        if (sidebar.style.display === 'none' || sidebar.style.display === '') {
            sidebar.style.display = 'block';
            // Añadir un pequeño retraso para que la transición del left funcione
            setTimeout(() => {
                sidebar.classList.add('sidebar-visible');
            }, 10);
        } else {
            sidebar.classList.remove('sidebar-visible');
            sidebar.addEventListener('transitionend', function() {
                if (!sidebar.classList.contains('sidebar-visible')) {
                    sidebar.style.display = 'none';
                }
            }, { once: true });
        }
    });
});


            </script>



