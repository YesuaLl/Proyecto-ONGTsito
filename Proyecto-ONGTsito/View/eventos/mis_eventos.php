<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor">
    <main class="contenido">
        <h2 style="text-align: center;">Eventos a los que me he unido</h2>

        <?php if (empty($eventos)): ?>
            <p style="text-align:center;">No te has unido a ningún evento todavía.</p>
        <?php else: ?>
            <div class="eventos-container">
                <?php foreach ($eventos as $evento): ?>
                    <div class="evento">
                        <h3><?= htmlspecialchars($evento["NOMBRE"]) ?></h3>
                        <p><strong>Fecha:</strong> <?= htmlspecialchars($evento["FECHA"]) ?></p>
                        <p><strong>Hora:</strong> <?= htmlspecialchars(substr($evento["HORA"], 0, 5)) ?></p>
                        <p><strong>Publicado por:</strong> <?= htmlspecialchars($evento["ADMIN_USUARIO"]) ?></p>
                        <?php if (!empty($evento["IMAGEN"])): ?>
                            <img src="uploads/<?= htmlspecialchars($evento["IMAGEN"]) ?>" style="max-width: 100%;">
                        <?php endif; ?>
                        <a href="eventos.php?accion=abandonar&id=<?= $evento["ID"] ?>" class="btn btn-eliminar">Abandonar</a>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
    <aside class="contenedor-aside">
        <?php include ("HTML/aside.html"); ?>
    </aside>
</div>

<?php include("HTML/pie.html"); ?>
