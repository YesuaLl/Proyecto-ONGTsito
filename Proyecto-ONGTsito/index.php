<?php 
session_start();
include_once("HTML/cabecera.html");
include_once("menu.php");
?>
<body>
  <div class="contenedor">


  <main>
  <section class="seccion-inspiradora">
  <h2>Lo que nos mueve</h2>
  <blockquote>
      "El verdadero poder está en servir a los demás."
  </blockquote>
    <p>Gracias a nuestros voluntarios y donantes, hemos logrado impactar cientos de vidas en comunidades vulnerables.</p>
  </section>

  <section class="seccion-imagenes">
  <div class="contenedor-imagenes">
      <div class="titulo-con-lineas">
      <hr>
      <h1>Fundación Tsito informa</h1>
      <hr> 
      <p>La Fundación Tsito es una organización sin fines de lucro dedicada a mejorar la calidad de vida de las personas en situación de vulnerabilidad.
      A través de programas educativos, asistencia social y proyectos comunitarios, buscamos generar un impacto positivo en la sociedad.</p>
      </div>
      <a href="eventos.php">
      <img src="img/alfa.jpg" alt="Imagen 1">
      </a>
      <a href="eventos.php">
      <img src="img/imagen1.jpg" alt="Imagen 2">
      </a>
      <a href="eventos.php">
      <img src="img/donacion.jpg" alt="Imagen 2">
      </a>
  </div>
  </section>

  <section id="about" class="seccion-clara">
          <h2>¿Quiénes Somos?</h2>
              <br>
      <div class="contenedor-about">
          <div class="texto-about">
              <p><strong>Fundación Tsito</strong> es una iniciativa joven nacida del compromiso de un grupo de personas que desean generar un impacto positivo en su comunidad. Aunque estamos dando nuestros primeros pasos, tenemos una visión clara: construir un futuro más justo, solidario y lleno de esperanza para quienes más lo necesitan.</p>

              <p>Nuestra fundación busca impulsar proyectos sociales que aborden necesidades reales, como el acceso a la educación, la salud y el bienestar comunitario. Comenzamos trabajando de manera cercana con las personas, escuchando sus historias y construyendo soluciones desde la empatía y la colaboración.</p>

              <p>Creemos firmemente en el poder de la unión y en que cada pequeña acción puede marcar una gran diferencia. Por eso, abrimos nuestras puertas a voluntarios, aliados y donantes que compartan nuestro propósito.</p>

              <p>Aunque aún estamos creciendo, ya hemos logrado organizar nuestras primeras actividades y estamos entusiasmados por lo que viene. ¡Este es solo el comienzo!</p> <br><br>

      <a href="index.php" style="display: block; text-align: center; font-size: 20px;">Inicio</a>
          </div>

          <div class="imagenes-about">
              <img src="img/logo.png" alt="Logo de Fundación Tsito" >
          </div>
      </div>
  </section>

  <section class="seccion-llamado">
    <h2>¿Quieres ser parte del cambio?</h2>
    <p>Únete como voluntario o haz una donación para apoyar nuestros programas.</p>
    <a href="contribuciones.php" class="boton-accion">¡Quiero ayudar!</a>
  </section>

  </main>
  <br><br>
  <?php include 'HTML/aside.html'; ?>

  </div>

<?php include 'HTML/pie.html'; ?>
</body>
</html>
