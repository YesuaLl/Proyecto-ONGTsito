<nav>
  <a href="index.php">Inicio</a>
  <a href="index.php#about">Sobre nosotros</a>
  <a href="eventos.php">Eventos</a>
  <a href="contribuciones.php">Contribuciones</a>

  <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
    <?php if (!empty($_SESSION["esAdmin"])): ?>
      <a href="voluntarios.php?accion=listar">Ver Voluntarios</a>
    <?php else: ?>
      <a href="voluntarios.php?accion=perfil">Mi Perfil</a>
      <a href="eventos.php?accion=misEventos">Mis Eventos</a>
      
    <?php endif; ?>

    <a href="logout.php">Cerrar Sesión</a>
  <?php else: ?>
    <a href="login.php">Iniciar sesión/ Registrarse</a>
  <?php endif; ?>
</nav>
