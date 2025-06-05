<?php
require_once("Model/mdlEvento.php");

class EventoController {
    // index muestra la lista de eventos
    public function index() {
        $nombre_usuario = $_SESSION["usuario"] ?? "Invitado";
        $esAdmin = $_SESSION["esAdmin"] ?? false;
        $usuario_logueado = isset($_SESSION["usuario"]);
        $idVoluntario = $_SESSION["id_voluntario"] ?? null;

        $eventos = Evento::obtenerTodos();
        $eventosUnidos = [];

    if ($idVoluntario) {
        $eventosUnidos = Evento::obtenerEventosPorVoluntario($idVoluntario);
        $eventosUnidos = array_column($eventosUnidos, "ID");
    }

    include("view/eventos/lista.php");
}
    
    //Crear un nuevo evento
    public function crear() {
    $esAdmin = $_SESSION["esAdmin"] ?? false;

    if (!$esAdmin) {
        header("Location: eventos.php");
        exit;
    }

    $mensaje = "";
    $evento = [
        "NOMBRE" => "",
        "FECHA" => "",
        "HORA" => "",
        "IMAGEN" => ""
    ];

    // Si se envía el formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = $_POST["nombre"];
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"] ?? '';
        $admin = $_SESSION["usuario"];
        $imagen = "";

        if (!empty($_FILES["archivo"]["name"])) {
            $imagen = basename($_FILES["archivo"]["name"]);
            move_uploaded_file($_FILES["archivo"]["tmp_name"], "uploads/" . $imagen);
        }

        Evento::crear($nombre, $fecha, $hora, $imagen, $admin);
        header("Location: eventos.php");
        exit;
    }

    include("view/eventos/formulario.php");
    }

    //Unirse a un evento
    public function unirse() {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["rol"] !== "voluntario") {
        header("Location: login.php");
        exit;
    }

    $idEvento = $_GET["id"] ?? null;
    $idVoluntario = $_SESSION["id_voluntario"];

    if ($idEvento) {
        Evento::unirseEvento($idVoluntario, $idEvento);
    }

    header("Location: eventos.php");
    }
    
    //Muestra los eventos a los que se ha unido un voluntario
    // Solo los voluntarios pueden ver sus eventos
    public function misEventos() {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["rol"] !== "voluntario") {
        header("Location: login.php");
        exit;
    }

    $idVoluntario = $_SESSION["id_voluntario"];
    $eventos = Evento::obtenerEventosPorVoluntario($idVoluntario);

    include("view/eventos/mis_eventos.php");
    }


    
    //Edita un evento existente
    public function editar() {
        $id = $_GET["id"] ?? null;
        $esAdmin = $_SESSION["esAdmin"] ?? false;

        if (!$esAdmin || !$id) {
            header("Location: eventos.php");
            exit;
        }

        $evento = Evento::obtenerPorId($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombre"];
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];
            $admin = $_SESSION["usuario"];
            $imagen = $evento["IMAGEN"];

            if (!empty($_FILES["archivo"]["name"])) {
                $imagen = basename($_FILES["archivo"]["name"]);
                move_uploaded_file($_FILES["archivo"]["tmp_name"], "uploads/" . $imagen);
            }

            Evento::actualizar($id, $nombre, $fecha, $hora, $imagen, $admin);
            header("Location: eventos.php");
            exit;
        }
        
        include("view/eventos/formulario.php");
    }

    public function eliminar() {
        $id = $_GET["id"] ?? null;
        $esAdmin = $_SESSION["esAdmin"] ?? false;

        if ($esAdmin && $id) {
            Evento::eliminar($id);
        }

        header("Location: eventos.php");
        exit;
    }

    public function abandonar() {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["rol"] !== "voluntario") {
        header("Location: login.php");
        exit;
    }

    $idEvento = $_GET["id"] ?? null;
    $idVoluntario = $_SESSION["id_voluntario"];

    if ($idEvento) {
        Evento::abandonarEvento($idVoluntario, $idEvento);
    }

    header("Location: eventos.php");
}

}
