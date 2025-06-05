<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>
<h2 style="text-align:center;">Cambiar Contraseña</h2>

<?php if (!empty($error)): ?>
<p style="color:red; text-align:center;"><?= $error ?></p>
<?php endif; ?>

<form method="POST" style="text-align:center;">
    <label>Nueva contraseña:</label><br>
    <input type="password" name="nueva" required><br><br>

    <label>Confirmar contraseña:</label><br>
    <input type="password" name="confirmar" required><br><br>

    <button type="submit">Guardar</button>
</form>
<?php include("HTML/pie.html"); ?>
