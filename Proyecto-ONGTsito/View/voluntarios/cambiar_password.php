<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor">
    <main class="contenido">
        <h2>Cambiar Contraseña</h2>

        <?php if (!empty($mensaje)): ?>
            <p style="color: <?= str_contains($mensaje, 'correctamente') ? 'green' : 'red' ?>;">
                <?= htmlspecialchars($mensaje) ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <label>Contraseña actual:</label>
            <input type="password" name="actual" required><br>

            <label>Nueva contraseña:</label>
            <input type="password" name="nueva" required><br>

            <label>Confirmar nueva contraseña:</label>
            <input type="password" name="confirmar" required><br>

            <button type="submit">Cambiar</button>
        </form>
    </main>
</div>

<?php include("HTML/pie.html"); ?>
