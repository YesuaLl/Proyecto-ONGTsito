<?php
require_once("model/MdlContribucion.php");

class ContribucionController {
    public function __construct() {
    
        if (!isset($_SESSION["usuario"])) {
            header("Location: login.php");
            exit;
        }
    }

    // Lista todas las contribuciones (admin) con nombre de evento
    public function index() {
        $esAdmin = $_SESSION["esAdmin"] ?? false;

        if (!$esAdmin) {
            header("Location: contribuciones.php?accion=crear");
            exit;
        }

        // Obtiene contribuciones con el nombre del evento
        $contribuciones = Contribucion::obtenerTodasConEvento();
        include("view/contribuciones/lista.php");
    }

    // Formulario para registrar contribución (solo voluntarios)
    public function crear() {
    $esAdmin = $_SESSION["esAdmin"] ?? false;

    if ($esAdmin) {
        // Si es admin, redirige al listado completo
        header("Location: contribuciones.php?accion=index");
        exit;
    }

    $mensaje = "";
    // Datos iniciales
    $contribucion = [
        "NOMBRE" => $_SESSION["nombre_voluntario"] ?? "",
        "APELLIDOPATERNO" => $_SESSION["ap_paterno_voluntario"] ?? "",
        "APELLIDOMATERNO" => $_SESSION["ap_materno_voluntario"] ?? "",
        //"PAIS" => "",
        "TIPODECONTRIBUCION" => "",
        "ID_EVENTO" => null
    ];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = $_SESSION["nombre_voluntario"] ?? "";
        $appaterno = $_SESSION["ap_paterno_voluntario"] ?? "";
        $apmaterno = $_SESSION["ap_materno_voluntario"] ?? "";
        $pais = $_POST["pais"] ?? "";
        $id_voluntario = $_SESSION["id_voluntario"] ?? null;
        $id_evento = $_POST["id_evento"] ?? null;

        $tipoSeleccionado = $_POST["tipo"] ?? "";
        $otroTipo = trim($_POST["otro_tipo"] ?? "");

        $tipo = ($tipoSeleccionado === "Otro" && !empty($otroTipo)) ? $otroTipo : $tipoSeleccionado;

        if ($nombre && $appaterno && $apmaterno /*&& $pais*/ && $tipo && $id_voluntario && $id_evento) {
            Contribucion::crear($nombre, $appaterno, $apmaterno, /*$pais,*/ $tipo, $id_voluntario, $id_evento);
            $mensaje = "Contribución registrada con éxito.";
        } else {
            $mensaje = "Error: faltan datos para registrar la contribución.";
        }
    }

    // Obtener eventos disponibles para el formulario
    $eventos = Contribucion::obtenerEventosDisponibles();

    // Aquí hacemos la diferenciación:
    $misContribuciones = Contribucion::obtenerPorVoluntario($_SESSION["id_voluntario"]);

    include("view/contribuciones/formulario.php");
}




    // Editar contribución (solo admin)
    public function editar() {
        $esAdmin = $_SESSION["esAdmin"] ?? false;
        $id = $_GET["id"] ?? null;

        if (!$esAdmin || !$id) {
            header("Location: contribuciones.php?accion=index");
            exit;
        }

        $contribucion = Contribucion::obtenerPorId($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombre"] ?? "";
            $appaterno = $_POST["appaterno"] ?? "";
            $apmaterno = $_POST["apmaterno"] ?? "";
  
            $tipo = $_POST["tipo"] ?? "";
            $id_evento = $_POST["id_evento"] ?? null;

            Contribucion::actualizar($id, $nombre, $appaterno, $apmaterno, $tipo, $id_evento);
            header("Location: contribuciones.php?accion=index");
            exit;
        }

        // Para editar, también obtener la lista de eventos
        $eventos = Contribucion::obtenerEventosDisponibles();

        include("view/contribuciones/formulario.php");
    }


    public function eliminar() {
       
        $id = $_GET["id"] ?? null;


            Contribucion::eliminar($id);
        

        header("Location: contribuciones.php?accion=index");
        exit;
    }
}
