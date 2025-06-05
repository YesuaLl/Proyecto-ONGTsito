<?php include("HTML/cabecera.html"); ?>
<?php include("menu.php"); ?>

<div class="contenedor-formulario"><br><br>
    <main class="contenido">
        <h2>Registrarse como Voluntario</h2>
        <p style="color: red;"><?php echo $mensaje; ?></p>

        <form action="registrar.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>

            <label for="apellidoPaterno">Apellido Paterno:</label>
            <input type="text" name="apellidoPaterno" required><br>

            <label for="apellidoMaterno">Apellido Materno:</label>
            <input type="text" name="apellidoMaterno" required><br>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" required><br>

            <label for="sexo">Sexo:</label>
            <select name="sexo" required>
                <option value="">Selecciona</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select><br>

            <label for="telefono">Teléfono (opcional):</label>
            <input type="text" name="telefono"><br>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required><br>

            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" name="confirm_password" required><br><br>

            <button class="btn-registrar" type="submit">Registrarme</button>
        </form>

        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </main>

    <div class="contenedor-aside">
        <?php include 'HTML/aside.html'; ?>
    </div>
</div>

<?php include 'HTML/pie.html'; ?>
