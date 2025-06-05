<?php
require_once("Model/MdlVoluntario.php");

class VoluntarioController {
   public function __construct() {
    // Redirige si no ha iniciado sesión
    if (!isset($_SESSION["usuario"])) {
        header("Location: login.php");
        exit;
    }
    // Permite continuar tanto a admins como voluntarios
    }


    public function perfil() {
        $id = $_SESSION["id_voluntario"] ?? null;

        if (!$id) {
          header("Location: login.php");
          exit;
        }
        $voluntario = Voluntario::obtenerPorId($id);
        include("view/voluntarios/perfil.php");
    }

    public function listar() {
    $esAdmin = $_SESSION["esAdmin"] ?? false;

    if (!$esAdmin) {
        header("Location: index.php");
        exit;
    }

    $voluntarios = Voluntario::obtenerTodos();

    //Aquí se agrega los eventos unidos a cada voluntario
    foreach ($voluntarios as &$vol) {
        $vol["EVENTOS"] = Voluntario::obtenerEventosPorVoluntario($vol["id"]);
    }

    include("view/voluntarios/lista.php");
    }



    public function editar() {
        $id = $_SESSION["id_voluntario"];
        $voluntario = Voluntario::obtenerPorId($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombre"];
            $correo = $_POST["correo"];
            $telefono = $_POST["telefono"];

            Voluntario::actualizar($id, $nombre, $correo, $telefono);
            header("Location: voluntarios.php?accion=perfil");
            exit;
        }

        include("view/voluntarios/formulario.php");
    }

    public function eliminar() {
    $esAdmin = $_SESSION["esAdmin"] ?? false;
    $id = $_GET["id"] ?? null;

    if ($esAdmin && $id) {
        Voluntario::eliminar($id);
    }

    header("Location: voluntarios.php?accion=listar");
    exit;
    }

    public function cambiarPassword() {
    $id = $_SESSION["id_voluntario"] ?? null;
    if (!$id) {
        header("Location: login.php");
        exit;
    }

    $mensaje = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $actual = $_POST["actual"];
        $nueva = $_POST["nueva"];
        $confirmar = $_POST["confirmar"];

        $voluntario = Voluntario::obtenerPorId($id);
        $hashGuardado = $voluntario["CONTRASEÑA"];

        if (!password_verify($actual, $hashGuardado)) {
            $mensaje = "Contraseña actual incorrecta.";
        } elseif ($nueva !== $confirmar) {
            $mensaje = "Las contraseñas nuevas no coinciden.";
        } else {
            $nuevoHash = password_hash($nueva, PASSWORD_DEFAULT);
            Voluntario::actualizarPassword($id, $nuevoHash);
            $mensaje = "Contraseña actualizada correctamente.";
        }
      }

    include("view/voluntarios/cambiar_password.php");
    }

}
