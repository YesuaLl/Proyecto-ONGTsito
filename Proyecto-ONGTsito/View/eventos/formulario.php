<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor">
    <main class="contenido">
        <h2 style="text-align:center;">
            <?= isset($evento["ID"]) ? "Editar Evento" : "Crear Nuevo Evento" ?>
        </h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nombre">Nombre del evento:</label>
            <input type="text" id="nombre" name="nombre" required value="<?= htmlspecialchars($evento['NOMBRE']) ?>"><br><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required value="<?= htmlspecialchars($evento['FECHA']) ?>"><br><br>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" value="<?= htmlspecialchars($evento['HORA']) ?>"><br><br>

            <label for="archivo">Imagen del evento:</label>
            <input type="file" id="archivo" name="archivo" accept="image/*"><br><br>

            <?php if (!empty($evento["IMAGEN"])): ?>
                <small>Imagen actual: <img src="uploads/<?= htmlspecialchars($evento["IMAGEN"]) ?>" style="max-width: 100px;"></small><br><br>
            <?php endif; ?>

            <div style="text-align: center;">
                <button type="submit" class="btn-registrar">
                    <?= isset($evento["ID"]) ? "Guardar Cambios" : "Crear Evento" ?>
                </button>
            </div>
        </form>
    </main>

    <aside class="contenedor-aside">
        <?php include 'HTML/aside.html'; ?>
    </aside>
</div>

<?php include_once("HTML/pie.html"); ?>
