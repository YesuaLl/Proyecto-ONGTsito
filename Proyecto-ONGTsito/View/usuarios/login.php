<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor-formulario"><br><br>
    <main class="contenido">
        <h2>Iniciar Sesión</h2>
        <?php if (!empty($mensaje)): ?>
            <p style="color: red; text-align: center;"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="txtUsuario">Correo Electrónico:</label>
            <input type="text" id="txtUsuario" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br>

            <button class="btn-iniciar" type="submit">Iniciar Sesión</button>
        </form>

        <p style="text-align: center;">¿No tienes una cuenta de voluntario?</p>
        <a href="registrar.php" class="btn-registrar" style="display: block; text-align: center;">Regístrate como voluntario</a>
    </main>

    <div class="contenedor-aside">
        <?php include 'HTML/aside.html'; ?>
    </div>
</div>

<br><br>
<?php include 'HTML/pie.html'; ?>
