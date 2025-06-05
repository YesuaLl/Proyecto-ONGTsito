<?php
session_start();
require_once("controller/ContribucionController.php");

// Determinar la acción a realizar
// Si no se especifica una acción, se usa "index" si el usuario es admin, o "crear" si no lo es.
$accion = $_GET["accion"] ?? (
    ($_SESSION["esAdmin"] ?? false) ? "index" : "crear"
);

$controlador = new ContribucionController();

if (method_exists($controlador, $accion)) {
    $controlador->$accion();
} else {
    echo "Acción no válida.";
}
