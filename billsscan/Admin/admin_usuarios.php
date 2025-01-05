<?php require('../layout/plantilla_admin.php') ?>



<style>
  .historial {
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
  }

  .contenedor-scroll {
    max-height: 400px;
    /* Ajusta la altura según tus necesidades */
    overflow-y: scroll;
    padding: 16px;
    border: none;
    width: 98%;
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

  .titulo {
    margin-top: 0;
    margin-bottom: 0;
  }

  .btn-add {
    background-color: #3e5a82;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-family: 'Jost';
    font-size: 16px;
    margin-left: 55px;
    /* Alinea el botón con el título */
    margin-bottom: 5px;
    /* Espacio debajo del botón */
  }

  .btn-add:hover {
    background-color: #2d4a6e;
  }

  /* Estilo para el botón de agregar */
  .btn-add {
    background-color: #4CAF50;
    /* Verde */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    margin-bottom: 5px;
  }

  .btn-add:hover {
    background-color: #45a049;
  }

  /* Estilo para el botón de editar */
  .btn-edit {
    background-color: #2196F3;
    /* Azul */
    color: white;
    padding: 8px 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
    margin-bottom: 5px;
  }

  .btn-edit:hover {
    background-color: #0b7dda;
  }

  /* Estilo para el botón de eliminar */
  .btn-delete {
    background-color: #f44336;
    /* Rojo */
    color: white;
    padding: 8px 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
  }

  .btn-delete:hover {
    background-color: #da190b;
  }

  /* Estilos para la imagen de perfil */
  .foto_p {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
  }

  @media screen and (min-width: 1420px) {
    .contenedor-scroll {
    max-height: 600px;
    /* Ajusta la altura según tus necesidades */
    overflow-y: scroll;
    padding: 16px;
    border: none;
    width: 98%;
  }

  .historial {
    display: flex;
    width: 90%;
    justify-content: center;
    align-items: center;
    margin-left: 100px;
  }
    }


    @media screen and (max-width: 916px) {
      .modal{
        z-index: 10000000000000000 !important;
      }
    }
</style>

<h2 class="titulo">Administrar empleados</h2>
<button id="addEmployeeButton" class="btn-add">Agregar Nuevo Empleado</button>

<div class="historial">
  <div class="contenedor-scroll">
    <table>
      <thead>
        <tr>
          <th class="thead-th">Foto de Perfil</th> <!-- Nueva columna para la foto -->
          <th class="thead-th">Nombre empleado</th>
          <th class="thead-th">Apellido</th>
          <th class="thead-th">Teléfono</th>
          <th class="thead-th">Correo</th>
          <th class="thead-th">Total de tickets</th>
          <th class="thead-th">Total gastado</th>
          <th class="thead-th">Tipo</th>
          <th class="thead-th">Acciones</th>
        </tr>
      </thead>

      <tbody>
        <?php
        include_once '../connection.php';


        $sql = $con->query("SELECT 
    u.id,
    u.fname AS nombre_empleado,
    u.lname AS apellido_empleado,
    u.phone AS telefono,
    u.email AS correo,
    u.password,
    COUNT(f.id) AS total_facturas,
    COALESCE(SUM(c.total_compra), 0) AS total_gastado,
    u.type AS tipo_usuario,
    CONCAT('../Normal/', u.foto_perfil) AS foto_perfil
FROM 
    user u
LEFT JOIN 
    facturas f ON u.id = f.user_id
LEFT JOIN 
    cambio c ON f.id = c.facturas_id
GROUP BY 
    u.id, u.fname, u.lname, u.phone, u.email
ORDER BY 
     u.type = 'Admin' desc, total_gastado asc");

        if ($sql) {
          while ($resultado = $sql->fetch_assoc()) {
        ?>
            <tr>
              <td><img src="<?php echo htmlspecialchars($resultado['foto_perfil']) ?: 'https://via.placeholder.com/100'; ?>" alt="Foto de perfil" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" class="foto_p"></td>
              <td><?php echo htmlspecialchars($resultado["nombre_empleado"]); ?></td>
              <td><?php echo htmlspecialchars($resultado["apellido_empleado"]); ?></td>
              <td><?php echo htmlspecialchars($resultado["telefono"]); ?></td>
              <td><?php echo htmlspecialchars($resultado["correo"]); ?></td>
              <td><?php echo htmlspecialchars($resultado["total_facturas"]); ?></td>
              <td><?php echo htmlspecialchars($resultado["total_gastado"]); ?></td>
              <td><?php echo htmlspecialchars($resultado["tipo_usuario"]); ?></td>
              <td class="actions">
              <button class="btn-edit" onclick="editEmployee('<?php echo $resultado['id']; ?>', '<?php echo $resultado['nombre_empleado']; ?>', '<?php echo $resultado['apellido_empleado']; ?>', '<?php echo $resultado['telefono']; ?>', '<?php echo $resultado['correo']; ?>', '<?php echo $resultado['tipo_usuario']; ?>', '<?php echo $resultado['password']; ?>')">Editar</button>
              <button class="btn-delete" onclick="deleteEmployee('<?php echo $resultado['id']; ?>')">Eliminar</button>
              </td>
            </tr>
        <?php
          }
        } else {
          echo "<tr><td colspan='8'>No se encontraron resultados</td></tr>";
        }

        $con->close();
        ?>

      </tbody>

    </table>
  </div>


</div>

<!-- Modal para editar empleado1 -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Editar Empleado</h2>
    <form id="editForm" action="actualizar_empleado.php" method="POST">
      <input type="hidden" name="id" id="editId">
      <label for="editFname">Nombre:</label>
      <input type="text" name="fname" id="editFname" required>
      <label for="editLname">Apellido:</label>
      <input type="text" name="lname" id="editLname" required>
      <label for="editPhone">Teléfono:</label>
      <input type="text" name="phone" id="editPhone" required>
      <label for="editEmail">Correo:</label>
      <input type="email" name="email" id="editEmail" required>
      <label for="editPassword">Cambiar su contraseña:</label>
      <input type="text" name="password" id="editPassword" required>
      <label for="editType">Tipo:</label>
      <select name="type" id="editType" required>
        <option value="Normal">Normal</option>
        <option value="Admin">Admin</option>
      </select>
      <button type="submit">Guardar Cambios</button>
    </form>
  </div>
</div>


<!-- Modal para agregar nuevo empleado2 -->
<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeAddModal">&times;</span>
    <h2>Agregar Nuevo Empleado</h2>
    <form id="addForm" action="agregar_empleado.php" method="POST">
      <label for="addFname">Nombre:</label>
      <input type="text" name="fname" id="addFname" required>
      <label for="addLname">Apellido:</label>
      <input type="text" name="lname" id="addLname" required>
      <label for="addPhone">Teléfono:</label>
      <input type="text" name="phone" id="addPhone" required>
      <label for="addEmail">Correo:</label>
      <input type="email" name="email" id="addEmail" required>
      <label for="addPassword">Asignar una contraseña:</label>
      <input type="password" name="password" id="addPassword" required>
      <label for="addType">Tipo:</label>
      <select name="type" id="addType" required>
        <option value="Normal">Normal</option>
        <option value="Admin">Admin</option>
      </select>
      <button type="submit">Agregar Empleado</button>
    </form>
  </div>
</div>


<style>
  /* Estilos para el modal */
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
  }

  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    animation: modalopen 0.5s;
  }

  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

  .modal-content h2 {
    margin-top: 0;
    font-family: 'Jost';
  }

  .modal-content label {
    display: block;
    margin-top: 10px;
    font-family: 'Jost';
  }

  .modal-content input,
  .modal-content select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    box-sizing: border-box;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-family: 'Jost';
  }

  .modal-content button {
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #3e5a82;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
  }

  .modal-content button:hover {
    background-color: #2d4a6e;
  }

  @keyframes modalopen {
    from {
      opacity: 0
    }

    to {
      opacity: 1
    }
  }
</style>

<?php
// Después de realizar la eliminación o actualización, establece el estado en el almacenamiento local
echo "<script>localStorage.setItem('status', 'actualizado');</script>";
?>

<script>
  // Variables para el modal de edición
  var editModal = document.getElementById("editModal");
  var addModal = document.getElementById("addModal");
  var spanEdit = document.getElementsByClassName("close")[0];
  var spanAdd = document.getElementById("closeAddModal");

  function editEmployee(id, fname, lname, phone, email, type, password) {
    // Establecer los valores de los campos de entrada
    document.getElementById("editId").value = id;
    document.getElementById("editFname").value = fname;
    document.getElementById("editLname").value = lname;
    document.getElementById("editPhone").value = phone;
    document.getElementById("editEmail").value = email;
    document.getElementById("editType").value = type;
    document.getElementById("editPassword").value = password; 

    // Mostrar el modal de edición
    editModal.style.display = "block";
}


  function openAddModal() {
    // Mostrar el modal para agregar
    addModal.style.display = "block";
  }

  // Cierra el modal de edición al hacer clic en la 'x'
  spanEdit.onclick = function() {
    editModal.style.display = "none";
  }

  // Cierra el modal para agregar al hacer clic en la 'x'
  spanAdd.onclick = function() {
    addModal.style.display = "none";
  }

  // Cierra los modales al hacer clic fuera de ellos
  window.onclick = function(event) {
    if (event.target == editModal) {
      editModal.style.display = "none";
    } else if (event.target == addModal) {
      addModal.style.display = "none";
    }
  }

  function deleteEmployee(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este empleado?')) {
      window.location.href = 'eliminar_empleado.php?id=' + id;
    }
  }

  // Manejo del botón para abrir el modal de agregar
  document.getElementById("addEmployeeButton").onclick = openAddModal;
</script>


<script>
  // Variables para el modal
  var modal = document.getElementById("editModal");
  var span = document.getElementsByClassName("close")[0];

  function editEmployee(id, fname, lname, phone, email, type, password) {
    // Establecer los valores de los campos de entrada
    document.getElementById("editId").value = id;
    document.getElementById("editFname").value = fname;
    document.getElementById("editLname").value = lname;
    document.getElementById("editPhone").value = phone;
    document.getElementById("editEmail").value = email;
    document.getElementById("editType").value = type;
    document.getElementById("editPassword").value = password; 

    // Mostrar el modal
    modal.style.display = "block";
  }

  // Cierra el modal al hacer clic en la 'x'
  span.onclick = function() {
    modal.style.display = "none";
  }

  // Cierra el modal al hacer clic fuera de él
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  function deleteEmployee(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este empleado?')) {
      window.location.href = 'eliminar_empleado.php?id=' + id;
    }
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    // Obtener el parámetro status de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    // Mostrar la alerta basada en el estado
    if (status === 'eliminado') {
      Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: 'El usuario ha sido eliminado correctamente.',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
      });
    } else if (status === 'error') {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Hubo un problema al eliminar el usuario.',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      });
    }
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    // Obtener el parámetro status de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    // Mostrar la alerta basada en el estado
    if (status === 'actualizado') {
      Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: 'Los datos del usuario han sido actualizados correctamente.',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
      });
    } else if (status === 'error') {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Hubo un problema al actualizar los datos del usuario.',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      });
    }
  });
</script>

<?php require('../layout/cierre_plantilla_admin.php') ?>