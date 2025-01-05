<?php require('../layout/plantilla_admin.php') ?>
<style>
    .historial {
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
    }

    .contenedor-scroll {
    max-height: 400px; /* Ajusta la altura según tus necesidades */
    overflow-y: scroll;
    padding: 16px;
    border: none;
    width: 90%;

    }

    table {
        border-collapse: collapse;
        width: 90%;
        font-family: 'Jost';
        margin-bottom: 22px;


    }

    .thead-th {
        background-color: #3e5a82;
        color: white;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
    }

    th {
        background-color: white;
    }

    h2 {
        margin-left: 55px;
        font-size: 40px;
        font-family: 'Jost';
    }

    @media screen and (min-width: 1420px) {
        .contenedor-scroll {
    max-height: 650px; /* Ajusta la altura según tus necesidades */
    overflow-y: scroll;
    padding: 16px;
    border: none;
    width: 90%;

    }
    }


    @media screen and (max-width: 916px) {
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
            width: 350px;
        }

        .contenedor-scroll{
            max-height: 550px !important;
        }

      
    }
</style>

<h2>Historial</h2>
<div class="historial">
    <div class="contenedor-scroll">
        <table>
            <thead>
                <tr>
                    <th class="thead-th">Empresa</th>
                    <th class="thead-th">Producto</th>
                    <th class="thead-th">Fecha y hora de registro</th>
                    <th class="thead-th">Empleado</th>
                </tr>
            </thead>

            <tbody>
                <?php
            include_once '../connection.php';

              
                $sql = $con->query("SELECT *
                FROM 
                    facturas f
                INNER JOIN emisor e ON f.emisor_id = e.id
                INNER JOIN importe i ON f.id = i.facturas_id
                INNER JOIN producto p ON f.id = p.facturas_id
                INNER JOIN user u on u.id=f.user_id
                                order by f.id asc
                ");

                while ($resultado = $sql->fetch_assoc()) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $resultado["denominacion_social"] ?></th>
                        <th scope="row"><?php echo $resultado["nombre"] ?></th>
                        <th scope="row"><?php echo $resultado["fecha_subida"] ?></th>
                        <th scope="row"><?php echo $resultado["fname"].$resultado["lname"] ?></th>

                    </tr>
                    
                <?php
            
                }

                ?>
            </tbody>
        </table>
    </div>                
</div>



<?php require('../layout/cierre_plantilla_admin.php') ?>