<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>
<h2 style="text-align:center;">Lista de Voluntarios</h2>

<table>
    <tr>
        <th>ID</th><th>Correo</th><th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u["ID"] ?></td>
        <td><?= htmlspecialchars($u["CORREO"]) ?></td>
        <td>
            <a href="usuarios.php?accion=editar&id=<?= $u["ID"] ?>">Cambiar contraseña</a> |
            <a href="usuarios.php?accion=eliminar&id=<?= $u["ID"] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include("HTML/pie.html"); ?>
