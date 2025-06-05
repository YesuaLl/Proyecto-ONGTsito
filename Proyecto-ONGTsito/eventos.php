<?php
session_start();
require_once("controller/EventoController.php");

$accion = $_GET["accion"] ?? "index";

$controller = new EventoController();

if (method_exists($controller, $accion)) {
    $controller->$accion();
} else {
    echo "Acción '$accion' no válida.";
}
