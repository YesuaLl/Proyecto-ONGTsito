<?php
session_start();

// Elimina todas las variables de sesión
$_SESSION = [];

// Destruye la sesión
session_destroy();

// Redirige al login (o a index si prefieres)
header("Location: login.php");
exit;
