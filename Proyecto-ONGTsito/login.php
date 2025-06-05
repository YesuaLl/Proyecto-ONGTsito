<?php
session_start();
require_once("controller/UsuarioController.php");

$controller = new UsuarioController();
$controller->login();
