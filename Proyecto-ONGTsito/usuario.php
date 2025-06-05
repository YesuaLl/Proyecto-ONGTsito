<?php
/*

*/
session_start();
require_once("controller/UsuarioController.php");

$accion = $_GET["accion"] ?? "index";
$controller = new UsuarioController();

if (method_exists($controller, $accion)) {
    $controller->$accion();
} else {
    echo "Acción '$accion' no válida.";
}
