<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor">
  <main>
    <h2 style="text-align:center;">Registro de contribuciones</h2>

    <?php if (!empty($mensaje)): ?>
        <p style="text-align:center; color:green;"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form class="formulario" action="" method="POST">
 


        <div class="form-row">
            <label for="tipo">Tipo de contribución:</label>
            <select id="tipo" name="tipo" required onchange="mostrarOtroCampo()">
                <option value="">Selecciona una opción</option>
                <option value="Mesas" <?= (isset($_POST['tipo']) && $_POST['tipo'] == 'Mesas') ? 'selected' : '' ?>>Mesas</option>
                <option value="Sillas" <?= (isset($_POST['tipo']) && $_POST['tipo'] == 'Sillas') ? 'selected' : '' ?>>Sillas</option>
                <option value="Comida" <?= (isset($_POST['tipo']) && $_POST['tipo'] == 'Comida') ? 'selected' : '' ?>>Comida</option>
                <option value="Otro" <?= (isset($_POST['tipo']) && $_POST['tipo'] == 'Otro') ? 'selected' : '' ?>>Otro Servicios</option>
            </select>
        </div>

        <div class="form-row" id="campoOtro" style="display: <?= (isset($_POST['tipo']) && $_POST['tipo'] == 'Otro') ? 'block' : 'none' ?>;">
            <label for="otro_tipo">Especifica:</label>
            <input type="text" id="otro_tipo" name="otro_tipo" value="<?= htmlspecialchars($_POST['otro_tipo'] ?? '') ?>">
        </div>

        <div class="form-row">
            <label for="id_evento">Evento:</label>
            <select id="id_evento" name="id_evento" required>
                <option value="">Selecciona un evento</option>
                <?php foreach ($eventos as $evento): ?>
                    <option value="<?= $evento['ID'] ?>" <?= (isset($_POST['id_evento']) && $_POST['id_evento'] == $evento['ID']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($evento['NOMBRE']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="text-align:center;">
            <button type="submit">Registrar</button>
        </div>
    </form>

    <?php if (!empty($misContribuciones)): ?>
        <h3 style="text-align:center;">
            <?= ($_SESSION['esAdmin'] ?? false) ? 'Todas las contribuciones registradas' : 'Tus contribuciones registradas' ?>
        </h3>
        <div class="tabla-responsive">
            <table class="tabla-contribuciones">
                <thead>
                    <tr>
                        <th>Tipo de contribución</th>
                        <th>Nombre del evento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($misContribuciones as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c["TIPODECONTRIBUCION"]) ?></td>
                            <td><?= htmlspecialchars($c["NOMBRE_EVENTO"] ?? 'No asignado') ?></td>
                            <td>
                                <a href="contribuciones.php?accion=eliminar&id=<?= $c["ID"] ?>" class="btn btn-eliminar">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p style="text-align:center; color:gray;">
            <?= ($_SESSION['esAdmin'] ?? false) ? 'No hay contribuciones registradas.' : 'Aún no has hecho ninguna contribución.' ?>
        </p>
    <?php endif; ?>
  </main>

  <aside class="contenedor-aside">
      <?php include 'HTML/aside.html'; ?>
  </aside>
</div>

<?php include 'HTML/pie.html'; ?>
<script src="js/contribuciones.js"></script>
<script src="js/popup.js"></script>


