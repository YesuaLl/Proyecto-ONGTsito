<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor">
    <main class="contenido">
        <h2>Editar Datos</h2>

        <form method="POST" action="">
            <label>Nombre:</label>
            <input type="text" name="nombre" required value="<?= htmlspecialchars($voluntario["NOMBRE"]) ?>"><br>

            <label>Correo:</label>
            <input type="email" name="correo" required value="<?= htmlspecialchars($voluntario["CORREO"]) ?>"><br>

            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?= htmlspecialchars($voluntario["TELEFONO"]) ?>"><br>

            <button type="submit">Guardar</button>
        </form>
    </main>
</div>

<?php include("HTML/pie.html"); ?>

