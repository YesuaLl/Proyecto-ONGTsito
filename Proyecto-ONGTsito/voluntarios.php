<?php
session_start();
require_once("Controller/VoluntarioController.php");

$accion = $_GET["accion"] ?? "perfil";

$controlador = new VoluntarioController();

if (method_exists($controlador, $accion)) {
    $controlador->$accion();
} else {
    echo "Acción '$accion' no válida.";
}
