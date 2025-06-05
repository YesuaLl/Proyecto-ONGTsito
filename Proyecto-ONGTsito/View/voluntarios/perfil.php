<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor">
    <main class="contenido">
        <h2>Mi Perfil</h2>

        <?php if ($voluntario): ?>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($voluntario["NOMBRE"] ?? "") ?></p>
            <p><strong>Correo:</strong> <?= htmlspecialchars($voluntario["CORREO"] ?? "") ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($voluntario["TELEFONO"] ?? "") ?></p>
        <?php else: ?>
            <p style="color: red;">No se pudo cargar la información del voluntario.</p>
        <?php endif; ?>

        <a href="voluntarios.php?accion=editar" class="btn btn-editar">Editar mis datos</a>
        <a href="voluntarios.php?accion=cambiarPassword" class="btn btn-editar">Cambiar Contraseña</a>
    </main>
    <aside class="contenedor-aside">
        <?php include ("HTML/aside.html"); ?>
    </aside>
</div>

<?php include("HTML/pie.html"); ?>
