<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor">
    <main class="contenido">
        <h2 style="text-align:center;">¡Bienvenido <?= htmlspecialchars($nombre_usuario) ?>!</h2>

        <?php if ($esAdmin): ?>
            <div style="text-align:center; margin: 10px;">
                <a href="eventos.php?accion=crear" class="btn btn-crear">+ Crear nuevo evento</a>
            </div>

            <table class="tabla-eventos-admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Publicado por</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <td><?= $evento["ID"] ?></td>
                            <td><?= htmlspecialchars($evento["NOMBRE"]) ?></td>
                            <td><?= $evento["FECHA"] ?></td>
                            <td><?= substr($evento["HORA"], 0, 5) ?></td>
                            <td><?= $evento["ADMIN_USUARIO"] ?></td>
                            <td>
                                <?php if (!empty($evento["IMAGEN"])): ?>
                                    <img src="uploads/<?= $evento["IMAGEN"] ?>" width="100" alt="Imagen evento">
                                <?php else: ?>
                                    Sin imagen
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-editar" style="margin-left:1em;" href="eventos.php?accion=editar&id=<?= $evento["ID"] ?>" class="accion-popup">Editar</a>
                            <br>
                                <a class="btn btn-eliminar" href="eventos.php?accion=eliminar&id=<?= $evento["ID"] ?>" class="accion-popup">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <h3 style="text-align:center;">Eventos Disponibles</h3>
            <div class="eventos-container">
                <?php foreach ($eventos as $evento): ?>
                    <div class="evento">
                        <h3><?= htmlspecialchars($evento["NOMBRE"]) ?></h3>
                        <?php if (!empty($evento["IMAGEN"])): ?>
                            <img src="uploads/<?= htmlspecialchars($evento["IMAGEN"]) ?>" style="max-width: 100%;" alt="Imagen evento">
                        <?php endif; ?>
                        <p><strong>Fecha:</strong> <?= htmlspecialchars($evento["FECHA"]) ?></p>
                        <p><strong>Hora:</strong> <?= htmlspecialchars(substr($evento["HORA"], 0, 5)) ?></p>
                        <p><strong>Publicado por:</strong> <?= htmlspecialchars($evento["ADMIN_USUARIO"]) ?></p>

                        <?php
                            $yaPaso = strtotime($evento["FECHA"]) < strtotime(date("Y-m-d"));
                            $unido = in_array($evento["ID"], $eventosUnidos ?? []);
                        ?>

                        <?php if ($yaPaso): ?>
                            <p class="btn btn-vencido">Vencido</p>
                        <?php elseif ($usuario_logueado): ?>
                            <?php if ($unido): ?>
                                <p class="btn btn-unido">Ya te has unido</p>
                            <?php else: ?>
                                <a href="eventos.php?accion=unirse&id=<?= $evento["ID"] ?>" class="btn-editar">Unirse</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a style="color: #fff; background-color: #007bff;" href="login.php" class="btn btn-login">Inicia sesión para unirte</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php
            include_once 'Controller/estadisticasController.php';
            $controllerEstadisticas = new estadisticasController();
            $controllerEstadisticas->obtenerDatos();
            $dataGenero = $controllerEstadisticas->dataGenero;
            $dataFechas = $controllerEstadisticas->dataFechas;
            include 'estadisticasView.php';
        ?>
    </main>

    <aside class="contenedor-aside">
        <?php include("HTML/aside.html"); ?>
    </aside>
</div>

<?php include("HTML/pie.html"); ?>

<script src="js/popup.js"></script>
