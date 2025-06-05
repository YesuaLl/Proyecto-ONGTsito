<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor">
  <main class="contenido">
    <h2 style="text-align:center;">Contribuciones Registradas</h2>

    <?php if (!$esAdmin): ?>
      <div class="centrado">
          <a href="contribuciones.php?accion=crear" class="btn btn-crear">+ Registrar nueva contribución</a>
      </div>
    <?php endif; ?>

    <div class="tabla-responsive">
      <table class="tabla-contribuciones">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Tipo</th>
            <th>Evento</th>
            <th>ID Voluntario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($contribuciones as $c): ?>
          <tr>
            <td><?= $c["ID"] ?></td>
            <td><?= htmlspecialchars($c["NOMBRE"]) ?></td>
            <td><?= htmlspecialchars($c["APELLIDOPATERNO"]) ?></td>
            <td><?= htmlspecialchars($c["APELLIDOMATERNO"]) ?></td>
 
            <td><?= htmlspecialchars($c["TIPODECONTRIBUCION"]) ?></td>
            <td><?= htmlspecialchars($c["NOMBRE_EVENTO"] ?? 'Sin evento') ?></td>
            <td><?= htmlspecialchars($c["ID_VOLUNTARIO"]) ?></td>
            <?php if ($esAdmin): ?>
              <td>
                  <a href="contribuciones.php?accion=editar&id=<?= $c["ID"] ?>" class="btn btn-editar">Editar</a>
                  <a href="contribuciones.php?accion=eliminar&id=<?= $c["ID"] ?>" class="btn btn-eliminar">Eliminar</a>
              </td>
            <?php endif; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <aside class="contenedor-aside">
      <?php include 'HTML/aside.html'; ?>
  </aside>
</div>

<?php include("HTML/pie.html"); ?>

<!-- Cargar el script que manejará el popup para eliminar -->
<script src="js/popup.js"></script>
